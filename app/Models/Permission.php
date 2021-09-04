<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use LogsActivity;

    public $guarded = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This permission has been {$eventName}";
    }
    protected static $logAttributes = ['name','guard_name'];
    protected static $logOnlyDirty = true;
}
