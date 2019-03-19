<?php

namespace App\Http\Controllers\Admin;


use App\Models\AccessHistory;
use App\Models\Device;
use App\Models\EquipmentInspection;

class SiteController extends BaseController
{
    public function welcome()
    {
        $data['try_devices_count'] = 0;
        $data['try_device'] = 0;
        $data['active_today'] = 0;
        $data['inspections_today'] = 0;
        return view('admin.site.welcome', ['data' => $data]);
    }

}