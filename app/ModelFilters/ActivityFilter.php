<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ActivityFilter extends ModelFilter
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
        return $this->where('log_name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('subject_type', 'LIKE', "%$query%");
    }

    public function id($query)
    {
        return $this->where('id', $query);
    }

    public function logName($query)
    {
        return $this->where('log_name', 'LIKE', "%$query%");
    }

    public function description($query)
    {
        return $this->where('description', 'LIKE', "%$query%");
    }

    public function subjectType($query)
    {
        return $this->where('subject_type', 'LIKE', "%$query%");
    }
}
