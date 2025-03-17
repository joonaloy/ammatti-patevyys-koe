<x-center>
    <form action="/koe/result" method="POST" class="bg-white p-10 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class='text-3xl font-bold mb-6 text-center'> {{session("Etunimi")}} {{session("Sukunimi")}} </h2>
            @php
                if(session("Ryhmä") == "hlö"){
                    echo"<h1 class='text-2xl font-semibold mb-4 text-center'>Henkilöliikenteen Ammattipätevyyskoe</h1>";
                    echo"<h2 class='text-xl mb-8 text-center'>Vaihtoehdoista voi olla oikein yksi tai useampia.
                    Merkitse + jos vaihtoehto on oikein ja - jos vaihtoehto on väärin.<br />
                    Max 42p/Hyv 32p</h2>";
                }elseif(session("Ryhmä") == "kpl"){
                    echo"<h1 class='text-2xl font-semibold mb-4 text-center'>Tavaraliikenteen Ammattipätevyyskoe</h1>";
                    echo"<h2 class='text-xl mb-8 text-center'>Vaihtoehdoista voi olla oikein yksi tai useampia.
                    Merkitse + jos vaihtoehto on oikein ja - jos vaihtoehto on väärin.<br />
                    Max 39p/Hyv 30p</h2>";
                }
            @endphp
        @csrf
        @foreach ($array as $key => $values)
            <fieldset class='mb-4'>
                    <h3 class='text-lg font-semibold mb-2'>{{$index}}. {{$key}}</h3>
                    <div class='mb-1 flex items-center justify-between'>
                        <input type='hidden' name='{{$index}}a' value='off'>
                        <label for='{{$index}}a' class='mr-2'>{{$values[0]}}</label>
                        <input class='custom-checkbox' type='checkbox' name='{{$index}}a'>
                    </div>
                    <div class='mb-1 flex items-center justify-between'>
                        <input type='hidden' name='{{$index}}b' value='off'>
                        <label for='{{$index}}b' class='mr-2'>{{$values[1]}}</label>
                        <input class='custom-checkbox' type='checkbox' name='{{$index}}b'>
                    </div>
                    <div class='mb-1 flex items-center justify-between'>                                                                                                                                                       
                        <input type='hidden' name='{{$index}}c' value='off'>
                        <label for='{{$index}}c' class='mr-2'>{{$values[2]}}</label>
                        <input class='custom-checkbox' type='checkbox' name='{{$index}}c'>
                    </div>
                </fieldset>
                @php
                    $index+=1
                @endphp
        @endforeach
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 rounded-full transition duration-300 ease-in-out focus:outline-none focus:shadow-outline">Lähetä</button> 
    </form>
</x-center>
