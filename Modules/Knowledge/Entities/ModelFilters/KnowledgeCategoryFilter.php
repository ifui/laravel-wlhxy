<?php

namespace Modules\Knowledge\Entities\ModelFilters;

use EloquentFilter\ModelFilter;

class KnowledgeCategoryFilter extends ModelFilter
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
        return $this->where('name', 'LIKE', "%$query%");
    }

    public function id($query)
    {
        return $this->where('id', $query);
    }

    public function name($query)
    {
        return $this->where('name', 'LIKE', "%$query%");
    }
}
