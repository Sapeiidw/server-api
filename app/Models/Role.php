<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use LogsActivity;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This role has been {$eventName}";
    }
    protected static $logAttributes = ['name',];
    protected static $logOnlyDirty = true;
}
