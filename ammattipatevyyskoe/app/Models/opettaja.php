<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class opettaja extends Model
{
    //tietokannan opettaja malli
    protected $table = "opettaja";
    protected $guarded = ["Tunnus"] ;
}
