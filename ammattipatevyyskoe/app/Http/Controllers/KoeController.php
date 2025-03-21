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
        //hakee oppilaan vastattavat kysymykset
        $kysymykset = kysymykset::where("Ryhmä", session("Ryhmä"))->where("Sarja", session("Sarja"))->first();
        $array = $kysymykset->KysymysArray;
        $array  = json_decode($array, true);
        $index = 1;
        return view("koe.index", ["array" => $array, "index" => $index]);
    }
    public function login_view()
    {
        //kirjautumissivu
        return view("koe.login");
    }
    public function login(Request $request)
    {
        //oppilaan kirjautuminen
        $request->validate(["Tunnus" => "required"]);
        $user = user::where("Tunnus", $request->Tunnus)->first();
        if ($user == null || $user->Palautettu == 1) {
            return redirect("koe/login")->withErrors(["message" => "Väärä tai jo käytetty tunnus."]);
        }
        session([
            "Tunnus" => $user->Tunnus,
            "Etunimi" => $user->Etunimi,
            "Sukunimi" => $user->Sukunimi,
            "Ryhmä" => $user->Ryhmä,
            "Palautettu" => $user->Palautettu,
            "Sarja" => $user->Sarja
        ]);
        return redirect("koe");
    }
    public function result(Request $request)
    {
        //kokeen palautuksen validointi
        session(["Palautettu" => 1]);
        $vastaukset = vastaukset::where("Ryhmä", session("Ryhmä"))->where("Sarja", session("Sarja"))->first();
        $array = $vastaukset->VastausArray;
        $vastausArray  = json_decode($array, true);
        $request->request->remove("_token");
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
                    $Pisteet += 1;
                    $PisteMax += 1;
                } else {
                    $PisteMax += 1;
                }
            } else {
            }
        }

        $jsonEncodedArray = json_encode($Vastaus);

        $tz = "Europe/Helsinki";
        $timestamp = time();

        //palautus päivämäärä
        $dt = Carbon::createFromTimestamp($timestamp, $tz);
        $formattedDate = $dt->format('Y-m-d H:i:s');

        //tallentaa tietokantaan kokeen palautuksen
        $kysymykset = kysymykset::where("Ryhmä", session("Ryhmä"))->where("Sarja", session("Sarja"))->first();
        $kysymysArray = $kysymykset->KysymysArray;
        $user = user::where("Tunnus", session("Tunnus"))->first();
        $user->update([
            "Palautettu" => 1,
            "Pisteet" => $Pisteet,
            "Kysymykset" => $kysymysArray,
            "Palautus" => $jsonEncodedArray,
            "Pvm" => $formattedDate,
        ]);
        return view("koe.result", ["Pisteet" => $Pisteet, "PisteMax" => $PisteMax]);
    }
}
