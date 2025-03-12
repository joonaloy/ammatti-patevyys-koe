<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class opettaja extends Model
{
    protected $table = "opettaja";
    protected $guarded = ["Tunnus"] ;
}
