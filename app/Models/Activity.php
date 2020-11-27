<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Activitylog\Models\Activity as ModelActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends ModelActivity
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    use Filterable, LogsActivity;

}
