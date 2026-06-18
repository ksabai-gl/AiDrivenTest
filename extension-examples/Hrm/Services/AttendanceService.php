<?php

namespace Extensions\Hrm\Services;

use App\Exceptions\BadException;
use Extensions\Hrm\Models\TimeAttendance;
use Extensions\Hrm\Models\EndOfDayReport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class AttendanceService
{
    public function store(array $data)
    {
        if ($this->checkExists($data)->count() != false) {
            throw new BadException(__('You has been check in on today'));
        }
        $attendance = TimeAttendance::create(
            [
                'date' => date('Y-m-d', time()),
                'user_id' => $data['user_id'],
                'business_id' => $data['business_id'],
                'check_in_time' => date('H:i', time()),
                'note' => $data['note'] ?? null,
                'user_agent' => $data['user_agent'],
                'ip' => $data['ip'],
            ]
        );

        return $attendance;
    }
    public function update(array $data)
    {
        $row = $this->checkExists($data);
        if ($row->count() == false) {
            throw new BadException(__('You has not been check in on today'));
        }
        $row = $row->first();
        $data['check_out_time'] = $row->check_out_time ?? date('H:i',time());
        $attendance = $this->checkExists($data)->update($data);
        return $attendance;
    }

    public function index(array $data)
    {
        $attendances = TimeAttendance::select('hrm_time_attendances.*','users.name')
        ->join('users','users.id','=','hrm_time_attendances.user_id');
        if(!empty($data['permission'])){ 
            $attendances = $attendances->where('hrm_time_attendances.user_id', $data['user_id']);
        }
        if (!empty($data['year'])) {
            $attendances = $attendances->where('hrm_time_attendances.created_at', $data['year']);
        }
        if (!empty($data['month'])) {
            $attendances = $attendances->where('hrm_time_attendances.created_at', $data['month']);
        }

        return $attendances->paginate(15);
    }

    public function exportMonthlyReport($userId, $month, $year)
    {
        $attendances = TimeAttendance::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();

        $filename = "attendance_report_{$year}_{$month}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['Date', 'Check In', 'Check Out', 'Working Hours', 'Notes']);

            // CSV data
            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->date,
                    $attendance->check_in_time,
                    $attendance->check_out_time,
                    $attendance->working_hours,
                    $attendance->notes,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
    private function checkExists(array $data) : Builder {
        $row = TimeAttendance::where("date", date('Y-m-d', time()))
        ->where('user_id', $data['user_id'])
        ->where('business_id', $data['business_id']);
        if(!empty($data['id'])) { 
           $row = $row->where('id', $data['id']);
        }
        
        return $row;
    }
}
