<?php

namespace Extensions\Hrm\Services;

use App\Exceptions\BadException;
use App\Jobs\SendMailJob;
use App\Models\User;
use App\Notifications\CommonNotification;
use Carbon\Carbon;
use Extensions\Hrm\Models\LeaveRequest;
use Extensions\Hrm\Notifications\LeaveRequestSubmitted;
use Extensions\Hrm\Notifications\LeaveRequestApproved;
use Extensions\Hrm\Notifications\LeaveRequestRejected;
use Illuminate\Support\Facades\Notification;

class LeaveService
{
    public function createLeaveRequest(array $data)
    {
        $leaveRequest = LeaveRequest::create($data);

        // Send notification to approver
        $approver = $leaveRequest->approver;
        if ($approver) {
            Notification::send($approver, new LeaveRequestSubmitted($leaveRequest));
        }

        return $leaveRequest;
    }

    public function updateLeaveRequest($id, array $data)
    {
        $leaveRequest = $row = LeaveRequest::where('id',$id);
        if($leaveRequest->count() == false ) {
            throw new BadException(__('extension.hrm::messages.not_found'));
        }
        $leaveRequest->update([
            'status'=> $data['status'],
        ]);
        $row = $row->first();
        $user = User::find($row->user_id);
        $mailMessage = [
            'subject'=> __('extension.hrm::messages.mail.subject.' . $data['status'],[],$user->lang),
            'message' => __('extension.hrm::messages.mail.message.' . $data['status'],[
                'start_date'=>Carbon::parse($row['start_date'])->format('Y-m-d'),
                'end_date'=>Carbon::parse($row['end_date'])->format('Y-m-d'),
            ],$user->lang),
        ];
        // Send notification to employee
        SendMailJob::dispatch($row->user_id, $mailMessage['subject'],$mailMessage['message'],env('APP_URL'))->onQueue('low');

        return $leaveRequest;
    }

    public function getLeaveRequestsForUser(array $data)
    {
        return LeaveRequest::select("hrm_leave_requests.*","users.name")
        ->join("users","users.id","=","hrm_leave_requests.user_id")
        ->where('user_id', $data['user_id'])->paginate(15);
    }

    public function getLeaveRequestsAll(array $data)
    {
        return LeaveRequest::select("hrm_leave_requests.*","users.name")
        ->join("users","users.id","=","hrm_leave_requests.user_id")
        ->where('business_id', $data['business_id'])->paginate(15);
    }

    public function getPendingLeaveRequests()
    {
        return LeaveRequest::where('status', 'pending')->get();
    }
}