<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kysymykset;
use App\Models\opettaja;
use App\Models\user;
use App\Models\vastaukset;
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
        $user = user::where("Id",$id)->first();
        return view("opettaja.view",["user"=> $user]);
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
    public function edit_questions_view(Request $request)
    {
        $kysymykset = kysymykset::where("Ryhmä", $request["Ryhmä"])->where("Sarja",$request["Sarja"])->first();
        $kysymysArray = $kysymykset->KysymysArray;
        $vastaukset = vastaukset::where("Ryhmä", $request["Ryhmä"])->where("Sarja",$request["Sarja"])->first();
        $vastausArray = $vastaukset->VastausArray;
        return view("opettaja.edit_questions",["KysData"=>$kysymysArray,"VasData"=>$vastausArray,"Ryhmä"=>$request["Ryhmä"],"Sarja"=>$request["Sarja"]]);
    }
    public function edit_questions(Request $request)
    {
        $request->request->remove("_token");
        $Vastaus = $request->all();
        $Kysymykset = array();
        $Vastaukset = array();
        foreach ($Vastaus as $key => $value) {
            if(strlen($key) == 4 || strlen($key) == 5 && substr($key,-1) != "a"  && substr($key,-1) != "b"  && substr($key,-1) != "c" ){
                $Kysymykset[$Vastaus[$key]] = array($Vastaus[$key."a"],$Vastaus[$key."b"],$Vastaus[$key."c"]);
            }else if(strlen($key) == 2 || strlen($key) == 3){
                $Vastaukset[$key] = $value;
            }
        }
        $JsonKys = json_encode($Kysymykset);
        $JsonVas = json_encode($Vastaukset);
        $Ryhmä = $Vastaus["R"];
        $Sarja = $Vastaus["S"];

        $dbKys = kysymykset::where("Ryhmä", $Ryhmä)->where("Sarja",$Sarja)->first();
        $dbKys->update([
            "KysymysArray" => $JsonKys
        ]);
        $dbVas = vastaukset::where("Ryhmä", $Ryhmä)->where("Sarja",$Sarja)->first();
        $dbVas->update([
            "VastausArray" => $JsonVas
        ]);

        return view("opettaja.questions");
    }
}
