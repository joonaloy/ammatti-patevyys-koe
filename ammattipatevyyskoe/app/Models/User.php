<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    public $timestamps = false; // Disable Laravel's automatic timestamps
    protected $table = "user";
    protected $primaryKey = "Id";
    protected $fillable = [
        'Etunimi',      
        'Sukunimi',    
        'Tunnus',      
        'Palautettu', 
        'Ryhmä',     
        'Sarja',      
        'Pisteet',    
        'Pvm',      
        'Kysymykset', 
        'Palautus'    
    ];
    protected $casts = [
        'Palautettu' => 'boolean',
        'Ryhmä' => 'string',
        'Sarja' => 'integer',
        'Pisteet' => 'integer',
        'Pvm' => 'datetime'
    ];
}
