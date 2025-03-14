<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kysymykset;
use App\Models\user;
use Illuminate\Http\Request;

class KoeController extends Controller
{
    public function index()
    {
        $kysymykset = kysymykset::where("Ryhmä",session("Ryhmä"))->where("Sarja",session("Sarja"))->first();
        $array = $kysymykset->KysymysArray;
        $array  = json_decode($array, true);
        $index =1;
        return view("koe.index",["array" => $array,"index"=> $index]);
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
        return $request;
        //return view("koe.result");
    }
}
