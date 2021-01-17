<?php

namespace Modules\Classes\Entities\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Classes\Entities\ModelFilters\ClassesCourseFilter;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassesCourse extends Model
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    // SoftDeletes
    use Filterable, LogsActivity, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'content',
        'price',
        'thumb',
        'order',
        'status',
        'classes_grade_id',
    ];

    /**
     * 重写模型筛选目录路径
     *
     * @return string
     */
    public function provideFilter()
    {
        return ClassesCourseFilter::class;
    }

    /**
     * 关联表
     * 一对一
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function grade()
    {
        return $this->belongsTo(ClassesGrade::class, 'classes_grade_id', 'id');
    }
}
