<?php

namespace Modules\Knowledge\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Knowledge\Entities\Models\KnowledgeCategory;
use Modules\Knowledge\Http\Controllers\Controller;
use Modules\Knowledge\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(CategoryRequest $request)
    {
        $model = new KnowledgeCategory();

        return $model->filter($request->all())->OrderBy('order')->get()->toTree();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $model = new KnowledgeCategory();

        $model->fill($request->all());

        $model->save();

        return $this->success('分类创建成功');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return KnowledgeCategory::OrderBy('order')->descendantsAndSelf($id)->toTree();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $model = new KnowledgeCategory();

        try {
            $model = $model->find($id);

            $model->fill($request->all())->save();
        } catch (\Exception $e) {
            return $this->error('分类更新失败', 422, $e);
        }

        return $this->success('分类更新成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = new KnowledgeCategory();

        $model = $model->find($id);

        if (!$model) {
            return $this->error('该分类不存在', 404);
        }

        try {
            // 软删除
            $model->delete();
        } catch (\Exception $e) {
            return $this->error('分类删除失败', 422, $e);
        }

        return $this->success('分类删除成功');
    }
}
