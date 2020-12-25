<?php

namespace Modules\Knowledge\Entities\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Knowledge\Entities\ModelFilters\KnowledgeCategoryFilter;
use Spatie\Activitylog\Traits\LogsActivity;

class KnowledgeCategory extends Model
{
    // 树模型
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    // SoftDeletes
    use NodeTrait, Filterable, LogsActivity, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'order', 'parent_id', 'status',
    ];

    /**
     * 重写模型筛选目录路径
     *
     * @return string
     */
    public function provideFilter()
    {
        return KnowledgeCategoryFilter::class;
    }
}
