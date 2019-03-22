<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 获取Web分页参数
trait WebPagination{
    public function paginate(Request $request,$perPage = null) :array {
        $page = $request->input('page',0);
        if($perPage == null){
            $perPage = $request->input('per_page',20);
        }
        return [$page,$perPage,$perPage*$page];
    }
}