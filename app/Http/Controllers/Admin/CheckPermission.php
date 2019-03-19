<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

trait CheckPermission {
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