<?php

namespace Modules\Classes\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Modules\Classes\Entities\Models\ClassesPosition;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Classes\Http\Requests\Admin\PositionRequest;

class PositionController extends ClassesController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(PositionRequest $request)
    {
        $model = new ClassesPosition();

        return $model->with('course')->filter($request->all())->OrderBy('order')->paginateFilter();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PositionRequest $request)
    {
        $model = new ClassesPosition();

        try {
            $model->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->error('创建失败', 422, $e);
        }

        return $this->success('创建成功');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return ClassesPosition::with('course')->find($id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PositionRequest $request, $id)
    {
        $model = new ClassesPosition();

        $model = $model->find($id);

        if (!$model) {
            return $this->error('更新失败，没有找到该资源', 404);
        }

        try {

            $model->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->error('更新失败', 422, $e);
        }

        return $this->success('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = new ClassesPosition();

        $model = $model->find($id);

        if (!$model) {
            return $this->error('该资源不存在', 404);
        }

        try {
            $model->delete();
        } catch (\Exception $e) {
            return $this->error('删除失败', 422, $e);
        }

        return $this->success('删除成功');
    }
}
