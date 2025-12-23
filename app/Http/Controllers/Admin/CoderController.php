<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use LicenseBoxAPI;

class CoderController extends Controller
{
    //
    public function realityCheck()
    {
        // if (class_exists('LicenseBoxAPI')) {
        //     $api = new LicenseBoxAPI();
        //     $res = $api->verify_license();
        //     if ($res['status'] !== true) {
        //         Artisan::call('down');
        //         abort(503);
        //     }
        // } else {
        //     Artisan::call('down');
        // }
    }
}
