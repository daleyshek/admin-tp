<?php

namespace App\Utils;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

// Web网站的权限检查
trait WebPermissionCheck {
    public function can(...$permissions){
        $user = Auth::user();
        foreach ($permissions as $permission){
            if(!$user->can($permission)){
                $p = Permission::where('name',$permission)->first();
                abort("403",'您没有访问的权限：'.$p->display_name);
            }
        }
    }
}