<?php

namespace App\Http\Controllers\Admin;


use App\Models\AccessHistory;
use App\Models\Device;
use App\Models\EquipmentInspection;

class SiteController extends BaseController
{
    public function welcome()
    {
        $data = [4523,14,234,0];
        return view('admin.site.welcome', ['data' => $data]);
    }

}