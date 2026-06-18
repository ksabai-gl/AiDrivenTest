<?php

namespace Extensions\Hrm\Services;

use App\Exceptions\BadException;
use Extensions\Hrm\Models\MonthSummary;
use Illuminate\Support\Facades\URL;

class DownloadCsvService
{
    public function index(array $data)
    {
        $attendances = MonthSummary::select('hrm_month_summary.*', 'users.name')
            ->join('users', 'users.id', '=', 'hrm_month_summary.user_id');
        if (!empty($data['permission'])) {
            $attendances = $attendances->where('hrm_month_summary.user_id', $data['user_id']);
        }

        return $attendances->paginate(15);
    }
    public function findOne(array $data)
    {
        $row = MonthSummary::where('id', $data['id']);
        if ($row->count() == false) {
            throw new BadException(__("Not found data CSV"));
        }
        $row = $row->first();
        if (empty($data['permission'])) {
            if ($row->user_id !== $data['user_id']) {
                throw new BadException(__('Permission denied to download CSV'));
            }
        }
        $row->link = URL::temporarySignedRoute(
            'extension.hrm.download',
            now()->addMinute(),
            ['path' => $row->excel_file]
        );
        return $row;
    }
}
