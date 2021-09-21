<?php

namespace App\Models;

use Laravel\Passport\Client as PassportClient;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends PassportClient
{

    use LogsActivity;

    public $guarded = [];

    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @return bool
     */
    public function skipsAuthorization()
    {
        return true;
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Pengguna ini telah melakukan {$eventName} client";
    }
    
    public $logAttributes = ['name', 'redirect','url','thumbnail'];
    public $logOnlyDirty = true;

}
