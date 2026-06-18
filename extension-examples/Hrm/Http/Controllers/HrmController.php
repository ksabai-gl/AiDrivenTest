<?php

namespace Extensions\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Core\BusinessRole\Domain\Services\BusinessRoleService;
use Extensions\Hrm\Services\DownloadCsvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HrmController extends Controller
{
    public function index(Request $request) {
        return view("hrm::index");
    }
    public function download(Request $request) {
        $path = $request->query('path');

        abort_unless(
            Storage::disk('local')->exists($path),
            404
        );

        return Storage::disk('local')->download($path);
    }
}