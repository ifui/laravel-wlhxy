<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionRequest;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * 所有权限/筛选权限
     * 分页(筛选分页)
     * 筛选配置在 App\ModelFilters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionRequest $request)
    {
        $permissions = Permission::with('roles')->filter($request->all())->paginateFilter();

        return $permissions;
    }

    /**
     * 创建新权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();

        // 创建权限
        try {
            $permission->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->response->error('权限创建失败', 422);
        }

        // 分配角色
        try {
            $request->roles && $permission->syncRoles($request->roles);
        } catch (\Exception $e) {
            return $this->response->error('权限创建成功, 但在分配角色时发生错误', 422);
        }

        return $this->success('权限创建成功');
    }

    /**
     * 显示指定权限信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::with('roles')->find($id);

        return $permission;
    }

    /**
     * 更新权限信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return $this->response->errorNotFound('权限更新失败, 无法找到该权限');
        }

        // 更新权限
        try {
            $permission->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->response->error('权限更新失败', 422);
        }

        // 分配角色
        try {
            $request->roles && $permission->syncRoles($request->roles);
        } catch (\Exception $e) {
            return $this->response->error('权限更新成功, 但在分配角色时发生错误', 422);
        }

        return $this->success('权限更新成功');
    }

    /**
     * 删除权限
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            $permission->delete();
        } else {
            return $this->response->errorNotFound('权限删除失败, 无法找到该权限');
        }

        return $this->success('权限删除成功');
    }
}
