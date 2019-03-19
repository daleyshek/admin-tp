<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //汉字验证
        Validator::extend('character', function ($attribute, $value, $parameters, $validator) {
            if (preg_match('/^[\x80-\xff]+$/', $value)) {
                return true;
            }
            return false;
        });

        //国内手机号验证
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            if (preg_match('/^1[3-9][0-9]{9}$/', $value)) {
                return true;
            }
            return false;
        });

        //密码复杂度
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) < 6) {
                return false;
            }
            if (!preg_match('/^[a-zA-Z0-9@\._-]{6,}$/', $value) || preg_match('/^[\d]+$/', $value) || preg_match('/^[a-zA-Z]+$/', $value)) {
                return false;
            }
            return true;
        });
    }
}
