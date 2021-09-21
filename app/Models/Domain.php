<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This domain has been {$eventName}";
    }
    protected static $logAttributes = ['name'];
    protected static $logOnlyDirty = true;
}