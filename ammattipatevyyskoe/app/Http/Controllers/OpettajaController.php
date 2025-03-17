<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kysymykset;
use App\Models\opettaja;
use App\Models\user;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OpettajaController extends Controller
{
    //
    public function index()
    {
        $users = user::orderByDesc("Pvm")->get();
        return view("opettaja.index",["users"=>$users]);
    }
    public function login_view()
    {
        return view("opettaja.login");
    }
    public function login(Request $request)
    {
        $request->validate(["Tunnus" => "required"]);
        $oikeaTunnus = opettaja::all();
        if ($request["Tunnus"] == $oikeaTunnus->first()->Tunnus){
            session(["Opettaja" => True]);
            return redirect("/opettaja");
        }else{
            return redirect("/opettaja/login")->withErrors(["message"=>"Väärä tunnus"]);
        }
    }
    public function create_user_view()
    {
        return view("opettaja.create_user");
    }
    public function create_user(Request $request)
    {
        $request->validate(["Etunimi" => "required",
        "Sukunimi" => "required",
        "Ryhmä" => "required"]);
        $Tunnus = bin2hex(random_bytes(16));
        $count = kysymykset::where("Ryhmä",$request["Ryhmä"])->count();
        $Sarja = rand(1,$count);
        User::create(["Etunimi"=> $request["Etunimi"],"Sukunimi"=>$request["Sukunimi"],"Tunnus" => $Tunnus,"Ryhmä"=> $request["Ryhmä"],"Sarja"=> $Sarja]);
        return redirect("/opettaja");
    }
    public function view(string $id)
    {
        return $id;
    }
    public function delete(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect("/opettaja");
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
