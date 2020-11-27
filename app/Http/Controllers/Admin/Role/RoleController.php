<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * 所有角色/筛选角色
     * 分页(筛选分页)
     * 筛选配置在 App\ModelFilters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRequest $request)
    {
        $roles = Role::with('permissions')->filter($request->all())->paginateFilter();

        return $roles;
    }

    /**
     * 创建新角色
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();

        // 创建角色
        try {
            $role->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->response->error('角色创建失败', 422);
        }

        // 分配权限
        try {
            $request->permissions && $role->syncPermissions($request->permissions);
        } catch (\Exception $e) {
            return $this->response->error('角色创建成功, 但在分配权限时发生错误', 422);
        }

        return $this->success('角色创建成功');
    }

    /**
     * 显示指定角色信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->find($id);

        return $role;
    }

    /**
     * 更新角色
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->response->errorNotFound('角色更新失败, 无法找到该权限');
        }

        // 更新角色
        try {
            $role->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->response->error('角色更新失败', 422);
        }

        // 分配权限
        try {
            $request->permissions && $role->syncPermissions($request->permissions);
        } catch (\Exception $e) {
            return $this->response->error('角色更新成功, 但在分配权限时发生错误', 422);
        }

        return $this->success('角色更新成功');
    }

    /**
     * 删除角色
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();
        } else {
            return $this->response->errorNotFound('角色删除失败, 无法找到该角色');
        }

        return $this->success('角色删除成功');
    }
}
