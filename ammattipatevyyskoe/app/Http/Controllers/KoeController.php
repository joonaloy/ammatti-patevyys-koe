<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kysymykset;
use App\Models\vastaukset;
use App\Models\user;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
        session(["Palautettu" => 1]);
        $vastaukset = vastaukset::where("Ryhmä",session("Ryhmä"))->where("Sarja",session("Sarja"))->first();
        $array = $vastaukset->VastausArray;
        $vastausArray  = json_decode($array, true);
        $Vastaus = $request->all();
        $Pisteet = 0;
        $PisteMax = 0;
        foreach ($Vastaus as $key => $value) {
            if ($key === '_token') {
                continue;
            }
            if (isset($vastausArray[$key])) {
                if ($value === $vastausArray[$key]) {
                    //jos sama vastaus +1 piste
                    //echo "Match for $key: $value<br>";
                    $Pisteet +=1;
                    $PisteMax +=1;
                } else {
                    //echo "-------------------------No match for $key: $value (expected " . $VastausArray[$key] . ")<br>";
                    $PisteMax +=1;
                }
            } else {
                //echo "Key $key not found in reference array<br>";
            }
        }

        $jsonEncodedArray = json_encode($Vastaus);

        $tz = "Europe/Helsinki";
        $timestamp = time();

        // Using Carbon instead of DateTime
        $dt = Carbon::createFromTimestamp($timestamp, $tz);
        $formattedDate = $dt->format('Y-m-d H:i:s');

        $kysymykset = kysymykset::where("Ryhmä",session("Ryhmä"))->where("Sarja",session("Sarja"))->first();
        $kysymysArray = $kysymykset->KysymysArray;
        $user = user::where("Tunnus", session("Tunnus"))->first();
        $user->update([
            "Palautettu" => 1,
            "Pisteet" => $Pisteet,
            "Kysymykset" => $kysymysArray,
            "Palautus" => $jsonEncodedArray,
            "Pvm" => $formattedDate,
        ]);
        return view("koe.result",["Pisteet"=> $Pisteet,"PisteMax"=> $PisteMax]);
    }
}
