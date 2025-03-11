<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KoeController extends Controller
{
    public function index()
    {
        return view("koe.index");
    }
}
