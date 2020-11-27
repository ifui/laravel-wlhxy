<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PermissionFilter extends ModelFilter
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
        return $this->where('name', 'LIKE', "%$query%")
            ->orWhere('comment', 'LIKE', "%$query%")
            ->orWhere('id', 'LIKE', "%$query%");
    }

    public function id($id)
    {
        return $this->where('id', $id);
    }

    public function name($name)
    {
        return $this->where('name', 'LIKE', "%$name%");
    }

    public function guardName($guard)
    {
        return $this->where('guard_name', 'LIKE', "%$guard%");
    }

    public function comment($comment)
    {
        return $this->where('comment', 'LIKE', "%$comment%");
    }
}
