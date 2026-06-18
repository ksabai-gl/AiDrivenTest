<?php

namespace Extensions\Hrm\Services;

use App\Exceptions\BadException;
use Extensions\Hrm\Models\Report;

class ReportService
{
    public function store(array $data)
    {
        if(Report::where("date", date('Y-m-d',time()))->exists()) {
            throw new BadException(__('You has been create report in today'));
        }
        return Report::create([
            ...$data,
            'date' => date('Y-m-d',time())
        ]);
    }

    public function index(array $data)
    {
        $attendances = Report::select('hrm_end_of_day_reports.*','users.name')
        ->join('users','users.id','=','hrm_end_of_day_reports.user_id');
        if(!empty($data['permission'])){ 
            $attendances = $attendances->where('hrm_end_of_day_reports.user_id', $data['user_id']);
        }
        if(!empty($data['keywords'])){
            $attendances = $attendances->whereAny([
                'users.name',
                'users.email',
                'hrm_end_of_day_reports.date'
            ], 'like', '%'.$data['keywords'].'%');
        }
        return $attendances->orderBy("hrm_end_of_day_reports.id","DESC")->paginate(15);
    }
}