<?php

namespace Modules\Classes\Entities\ModelFilters;

use EloquentFilter\ModelFilter;

class ClassesPositionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 范围查询
     *
     * @param string $query
     * @return void
     */
    public function query($query)
    {
        return $this->where('title', 'LIKE', "%$query%");
    }

    public function id($query)
    {
        return $this->where('id', $query);
    }

    public function title($query)
    {
        return $this->where('title', 'LIKE', "%$query%");
    }
}
