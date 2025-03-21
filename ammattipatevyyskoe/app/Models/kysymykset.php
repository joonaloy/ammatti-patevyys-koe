<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kysymykset extends Model
{
    //tietokannan kysymys malli
    public $timestamps = false;
    protected $table = "kysymykset";
    protected $primaryKey = "Id";
    protected $fillable = [
        'Id',
        'Ryhma',
        'Sarja',
        'KysymysArray'
    ];

    protected $casts = [
        'KysymysArray' => 'string',
    ];
}
