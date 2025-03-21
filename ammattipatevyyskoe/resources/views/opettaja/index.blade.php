@php
use Carbon\Carbon;
@endphp
<!-- listaa kaikki oppilaat -->
<x-clean>
    <a class="border border-neutral-400 rounded p-0.5" href="/opettaja/create_user" id="luo-tunnus">Luo Tunnus</a>
    <a class="border border-neutral-400 rounded p-0.5" href="/opettaja/questions" id="kysymykset">Kysymykset</a>
    <table class='border border-neutral-600 ml-1'>
        <tr class='border border-neutral-600'>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Id</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Etunimi</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Sukunimi</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Tunnus</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Palautettu</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Ryhmä</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Sarja</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Pisteet</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Pvm</th>
            <th class='border border-x-neutral-400 border-y-neutral-600'>Toimia</th>
        </tr>
        @foreach ($users as $user)
        <tr class='border border-neutral-600'>
            @foreach ($user->toArray() as $key => $cell)
            @php
            //muuttaa numeron Kyllä tai Ei
            if ($key == 'Palautettu') {
            $cell = $cell == 1 ? 'Kyllä' : 'Ei';
            }
            if ($key == 'Pvm') {
            if($cell == null){
            $cell = "";
            }else{
            $date = Carbon::parse($cell);
            if ($date) {
            $cell = $date->format('d.m.Y H:i:s');
            }
            }
            }
            if($key == 'Id'){
            $Id = $cell;
            }
            //ei listaa oppilaan palautusta tai vastattuja kysmyksiä
            if($key == "Kysymykset" || $key == "Palautus"){
            continue;
            }
            @endphp
            <td class='border border-x-neutral-400 border-y-neutral-600'>{{$cell}}</td>
            @endforeach
            <!-- käyttää ennen hankittua oppilaan id:tä linkeissä -->
            <td> <a class='border border-neutral-400 rounded p-0.5 m-0.5' href='opettaja/view/{{ $Id }}'> Näytä/Tulosta</a> <a class='border bg-red-500 text-white border-neutral-400 rounded p-0.5 m-0.5' href='opettaja/delete/{{ $Id }}'> Poista</a></td>
            @endforeach
    </table>
</x-clean>