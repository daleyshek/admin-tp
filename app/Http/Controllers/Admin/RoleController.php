<?php

namespace App\Http\Controllers\Admin;


use App\Models\AccessSecret;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RoleController extends BaseController
{
    /**
     * 权限组列表
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roles(Request $request)
    {
        $this->can('user-group');
        if ($request->isMethod('POST')) {
            // 获取分页参数
            [$page,$perPage,$offset] = $this->paginate($request);

            $roles = Role::orderBy('id', 'asc')
            ->limit($perPage)
            ->offset($offset)
            ->get();
            $total = Role::count();
            return [
                'total' => $total,
                'page' => $page,
                'perPage' => $perPage,
                'maxPage' => ceil($total / $perPage),
                'labels' => [
                    'id' => '#.',
                    'display_name' => '角色',
                    'description' => '描述',
                ],
                'operations' => [
                    [
                        'label' => '编辑',
                        'icon' => '',
                        'class' => 'btn-default',
                        'bind' => 'id',
                        'pattern' => "/admin/permission/roles/{id}/edit",
                        'silent' => false,
                    ],
                    [
                        'label' => '删除',
                        'icon' => '',
                        'class' => 'btn-danger',
                        'bind' => 'id',
                        'pattern' => "/admin/permission/roles/{id}/delete",
                        'silent' => true,
                    ]
                ],
                'list' => $roles,
            ];
        }

        return view('admin.role.roles');
    }


    public function addRole(Request $request)
    {
        $this->can('user-group');
        if ($request->isMethod("POST")) {
            $this->validate($request, [
                'name' => 'required',
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $name = $request->post('name');
            $displayName = $request->post('display_name');
            $description = $request->post('description');

            if (Role::where('name', $name)->exists()) {
                throw ValidationException::withMessages([
                    'name' => '角色名已存在',
                ]);
            }
            $role = new Role();
            $role->name = $name;
            $role->display_name = $displayName;
            $role->description = $description;
            $role->save();
            return redirect(route("a.editRole", ['id' => $role->id]));

        }
        return view('admin.role.add');
    }

    public function editRole(Request $request, $id)
    {
        $this->can('user-group');
        $role = Role::find($id);
        if ($request->isMethod("POST")) {
            $this->validate($request, [
                'name' => 'required',
                'display_name' => 'required',
                'description' => 'required',
            ]);
            $name = $request->post('name');
            if (Role::where([
                ['name', '=', $name],
                ['id', '!=', $id],
            ])->exists()) {
                throw ValidationException::withMessages([
                    'name' => '角色名已存在',
                ]);
            }
            $displayName = $request->post('display_name');
            $description = $request->post('description');
            $role->name = $name;
            $role->display_name = $displayName;
            $role->description = $description;
            $role->save();
        }
        return view('admin.role.edit', ['role' => $role, 'id' => $id]);
    }

    public function deleteRole(Request $request, $id)
    {
        $this->can('user-group');
        Role::find($id)->delete();
        return 'success';
    }

    public function api(Request $request, $id)
    {
        $this->can('user-group');
        $role = Role::find($id);
        switch ($request->post('method')) {
            case 'getPermissions':
                $permissions = Permission::get();
                return $permissions;
                break;
            case 'getCheckedPermissions':
                if($role == null){
                    return [];
                }
                $permissions = $role->permissions()->pluck('id');
                return $permissions;
                break;
            case 'updateRolePermissions':
                $permissions = Permission::whereIn('id', $request->post('permissions'))->get();
                $role->syncPermissions($permissions);
                return ['message' => '保存成功'];
                break;
        }
    }

}