<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Utils\WebPermissionCheck;

class AccountController extends Controller
{
    use AuthenticatesUsers;
    use WebPermissionCheck;

    private $decayMinutes = 5;

    public function username()
    {
        return 'mobile';
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'mobile' => 'required',
                'password' => 'required',
            ]);

            //检测登陆次数
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }

            $user = User::where([
                ['mobile', '=', $request->post('mobile')],
            ])->first();

            if ($user != null) {
                if ($this->attemptLogin($request)) {
                    // 检查是否有后台的登陆权限
                    $this->can("admin-login");
                    return redirect(Route('m.welcome'));
                }
            }
            //登陆失败
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
        return view('admin.account.login');
    }

    /**
     * override
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('m.login'));
    }
}