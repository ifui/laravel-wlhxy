<?php

namespace Modules\Classes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Classes\Entities\Models\ClassesChapter;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Classes\Http\Requests\Admin\ChapterRequest;

class ChapterController extends ClassesController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ChapterRequest $request)
    {
        $model = new ClassesChapter();

        return $model->with('course')->filter($request->all())->OrderBy('order')->paginateFilter();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ChapterRequest $request)
    {
        $model = new ClassesChapter();

        try {
            $model->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->error('章节创建失败', 422, $e);
        }

        return $this->success('章节创建成功');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return ClassesChapter::with('course')->find($id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ChapterRequest $request, $id)
    {
        $model = new ClassesChapter();

        $model = $model->find($id);

        if (!$model) {
            return $this->error('章节更新失败，没有找到该课程', 404);
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
        $model = new ClassesChapter();

        $model = $model->find($id);

        if (!$model) {
            return $this->error('该章节不存在', 404);
        }

        try {
            $model->delete();
        } catch (\Exception $e) {
            return $this->error('删除失败', 422, $e);
        }

        return $this->success('删除成功');
    }
}
