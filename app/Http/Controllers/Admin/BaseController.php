<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Utils\WebPagination;
use App\Utils\WebPermissionCheck;

class BaseController extends Controller
{
    use WebPagination;
    use WebPermissionCheck;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * bootstrap label
     * @param $text
     * @param $status
     * @return string
     */
    public function makeLabel(string $text, string $status): string
    {
        $label = '<span class="%s">%s</span>';

        switch ($status) {
            case 'success':
                return sprintf($label, "label label-success", $text);
                break;
            case 'warning':
                return sprintf($label, "label label-warning", $text);
                break;
            case 'danger':
                return sprintf($label, "label label-danger", $text);
                break;
            case 'info':
                return sprintf($label, "label label-info", $text);
                break;
            default:
                return sprintf($label, "label label-default", $text);
                break;
        }
    }

    public function translateTimeToDuration($time){
        if($time == '' || $time == null) {
            return $time;
        }
        $now = time();
        $timeSeconds = \strtotime($time);
        $gap = $now - $timeSeconds;
        if($gap<120){
            return $gap.'s';
        }
        if($gap/60<60){
            return floor($gap/60).'分';
        }
        if($gap/3600<24){
            return floor($gap/3600).'小时';
        }
        if($gap/86400<30){
            return floor($gap/86400).'天';
        }
        return floor($gap/2592000).'月';
    }
}