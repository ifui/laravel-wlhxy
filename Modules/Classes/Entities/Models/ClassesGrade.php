<?php

namespace Modules\Classes\Entities\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Modules\Classes\Entities\ModelFilters\ClassesGradeFilter;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassesGrade extends Model
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    use Filterable, LogsActivity;

    protected $fillable = [
        'name',
        'remark',
        'color',
        'order',
        'status',
    ];

    /**
     * 重写模型筛选目录路径
     *
     * @return string
     */
    public function provideFilter()
    {
        return ClassesGradeFilter::class;
    }
}
