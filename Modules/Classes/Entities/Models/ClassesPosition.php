<?php

namespace Modules\Classes\Entities\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Modules\Classes\Entities\ModelFilters\ClassesPositionFilter;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassesPosition extends Model
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    use Filterable, LogsActivity;

    protected $fillable = [
        'title',
        'thumb',
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
        return ClassesPositionFilter::class;
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
