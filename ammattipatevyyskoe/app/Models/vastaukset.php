<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vastaukset extends Model
{
    public $timestamps = false; // Disable Laravel's automatic timestamps
    protected $table = "vastaukset";
    protected $primaryKey = "Id";
    protected $fillable = [
        'Id',
        'Ryhma',
        'Sarja',
        'VastausArray'
    ];

    protected $casts = [
        'VastausArray' => 'string',
    ];
}
