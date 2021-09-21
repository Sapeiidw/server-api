<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use LogsActivity;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Pengguna ini telah melakukan {$eventName} role";
    }
    protected static $logAttributes = ['name',];
    protected static $logOnlyDirty = true;
}
