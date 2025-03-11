<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class OpettajaController extends Controller
{
    //
    public function index()
    {
        $test = user::query()->orderByDesc("id")->get();
        dd($test);
        return view("opettaja.index");
    }
}
