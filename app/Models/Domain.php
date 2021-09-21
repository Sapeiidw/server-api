<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Domain extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = ['name'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Pengguna ini telah melakukan {$eventName} domain";
    }
    protected static $logAttributes = ['name'];
    protected static $logOnlyDirty = true;
}
