<?php

namespace App\Http\Controllers\Admin;


use App\Models\Device;
use App\Models\Role;
use App\Models\User;
use App\Models\AccessHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends BaseController
{

    /**
     * 用户列表
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users(Request $request)
    {
        
        $this->can('user-config');
        if ($request->isMethod('POST')) {
            // 获取分页参数
            [$page,$perPage,$offset] = $this->paginate($request);

            $sql = <<<sql
            select u.id,ANY_VALUE(u.name) as name,ANY_VALUE(u.mobile) as mobile,ANY_VALUE(u.status) as status,max(ah.created_at) as actived_at from users as u 
            left join access_histories as ah on ah.user_id = u.id
            where u.deleted_at is null
            group by u.id
            limit {$perPage}
            offset {$offset}     
sql;
            // $list = User::select('users.id', 'users.name', 'users.mobile', 'users.true_name', 'users.status')
            //     ->get();

            $list = DB::select(DB::raw($sql));

            foreach ($list as &$li) {
                $li->status = $this->makeLabel(User::STATUS_TEXTS[$li->status], User::STATUS_LEVELS[$li->status]);
                if($li->actived_at!=null){
                    $li->actived_at = $this->makeLabel($this->translateTimeToDuration($li->actived_at),'default');
                }
            }

            $total = User::count();
            return [
                'total' => $total,
                'page' => $page,
                'perPage' => $perPage,
                'maxPage' => ceil($total / $perPage),
                'labels' => [
                    'id' => '#.',
                    'name' => '用户名',
                    'mobile' => '手机号',
                    'actived_at' => '最近活动',
                    'status' => "状态",
                ],
                'operations' => [
                    [
                        'label' => '编辑',
                        'icon' => '',
                        'class' => 'btn-default',
                        'bind' => 'id',
                        'pattern' => '/admin/users/{id}/edit',
                        'silent' => false,
                    ],
                    [
                        'label' => '禁用',
                        'icon' => '',
                        'class' => 'btn-danger',
                        'bind' => 'id',
                        'pattern' => '/admin/users/{id}/disable',
                        'silent' => true,
                    ]
                ],
                'list' => $list,
            ];
        }
        return view('admin.user.users');
    }

    public function addUser(Request $request)
    {
        $this->can('user-config');
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|alpha_dash',
                'password' => 'required|string|password',
                'password_repeat' => 'required|string|same:password',
                'mobile' => 'required|cn_mobile|unique:users',
                'email' => 'nullable|email|unique:users',
                'gender' => 'required'
            ]);

            $name = $request->post('name');
            $mobile = $request->post('mobile');
            $password = $request->post('password');
            $email = $request->post('email');
            $gender = $request->post('gender');

            $user = new User();
            $user->name = $name;
            $user->mobile = $mobile;
            $user->password = bcrypt($password);
            $user->email = $email;
            $user->gender = $gender;
            $user->avatar = User::getDefaultAvatar($gender);
            $user->save();

            return redirect(route('a.editUser', ['id' => $user->id]));
        }
        return view('admin.user.addUser');
    }

    /**
     * 编辑用户
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUser(Request $request, $id)
    {
        $this->can('user-config');
        $user = User::find($id);
        if ($user == null) {
            throw new NotFoundHttpException("未找到该用户");
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|alpha_dash',
                'gender' => 'required',
                'role' => 'required|exists:roles,name',
            ]);

            $name = $request->post('name');
            $mobile = $request->post('mobile');
            $password = $request->post('password');
            $email = $request->post('email');
            $gender = $request->post('gender');
            $role = $request->post('role');
            $status = $request->post('status');

            $user->name = $name;
            if (!empty($password)) {
                $user->password = bcrypt($password);
            }

            DB::table('role_user')->where('user_id', $id)->delete();

            $user->gender = $gender;
            $user->avatar = User::getDefaultAvatar($gender);
            $user->attachRole(Role::where('name', $role)->firstOrFail());
            if($status == User::STATUS_DISABLED){
                $user->status = User::STATUS_ENABLED;
            }else{
                $user->status = $status;
            }
            $user->save();
            return redirect(route('a.editUser', ['id' => $user->id]));
        }

        $user->status_label = $this->makeLabel(User::STATUS_TEXTS[$user->status], User::STATUS_LEVELS[$user->status]);
        $roles = $user->roles;
        $userRole = count($user->roles) > 0 ? $user->roles[0]->name : null;
        $roleOptions = Role::get();
        
        return view('admin.user.editUser', ['user' => $user, 'roles' => $roles, 'userRole' => $userRole, 'roleOptions' => $roleOptions]);
    }

    public function disable($id = null)
    {
        $this->can('user-config');
        $user = User::find($id);
        switch ($user->status) {
            case User::STATUS_FORBIDDEN:
                $user->status = User::STATUS_ENABLED;
                break;
            case User::STATUS_ENABLED:
                $user->status = User::STATUS_FORBIDDEN;
                break;
        }
        if ($user->save()) {
            return 'success';
        }
        return response('fail', 500);
    }

    public function delete($id=null){
        $this->can('user-config');
        $user = User::find($id);
        $user->delete();
        return 'success';
    }
}