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
    public function login_view()
    {
        return view("koe.login");
    }
    public function login(Request $request)
    {
        return view("koe.index");
    }
    public function result(Request $request)
    {
        return $request["test"];
        //return view("koe.result");
    }
}
