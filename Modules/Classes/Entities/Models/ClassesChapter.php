<?php

namespace Modules\Classes\Entities\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Classes\Entities\ModelFilters\ClassesChapterFilter;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassesChapter extends Model
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    // SoftDeletes
    use Filterable, LogsActivity, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'price',
        'thumb',
        'time',
        'order',
        'status',
        'classes_course_id',
    ];

    /**
     * 重写模型筛选目录路径
     *
     * @return string
     */
    public function provideFilter()
    {
        return ClassesChapterFilter::class;
    }

    /**
     * 关联表
     * 一对一
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function course()
    {
        return $this->belongsTo(ClassesCourse::class, 'classes_course_id', 'id');
    }
}
