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
    public function login_view()
    {
        return view("opettaja.login");
    }
    public function login(Request $request)
    {
        return view("opettaja.index");
    }
    public function create_user_view()
    {
        return view("opettaja.create_user");
    }
    public function create_user(Request $request)
    {
        return view("opettaja.index");
    }
    public function view(string $id)
    {
        return $id;
    }
    public function delete(string $id)
    {
        return view("opettaja.index");
    }
    public function questions()
    {
        return view("opettaja.questions");
    }
    public function edit_questions_view(string $group, string $series)
    {
        return [$group, $series];
        //return view("opettaja.questions");
    }
    public function edit_questions(Request $request)
    {
        return view("questions.index");
    }
}
