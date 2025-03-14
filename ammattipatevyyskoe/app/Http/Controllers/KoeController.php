<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\user;
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
        $request->validate(["Tunnus" => "required"]);
        $user = user::where("Tunnus", $request->Tunnus)->first();
        if ($user == null || $user->Palautettu == 1) {
            return redirect("koe/login")->withErrors(["message"=>"Väärä tai jo käytetty tunnus."]);
        }
        session(["Tunnus" => $user->Tunnus,
            "Etunimi" => $user->Etunimi,
            "Sukunimi" => $user->Sukunimi,
            "Ryhmä"=>$user->Ryhmä,
            "Palautettu" => $user->Palautettu,
            "Sarja"=>$user->Sarja]);
        return redirect("koe");
    }
    public function result(Request $request)
    {
        return $request["test"];
        //return view("koe.result");
    }
}
