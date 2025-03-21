<!-- oppilaan palautuksen tarkasteleminen -->
<x-center>
    <form action="/" method="POST" id="koe" class="bg-white p-10 rounded-lg shadow-lg w-full max-w-2xl">
        <h1 class='text-2xl font-semibold mb-4 text-center'>Ammattipätevyyskoe</h1>
        <h2 class='text-3xl font-bold mb-6 text-center'> {{$user["Etunimi"]}} {{$user["Sukunimi"]}}</h2>
        <h2 class='text-3xl font-bold mb-6 text-center'> Palautettu: {{$user["Pvm"]}} </h2>
        @php
        $index = 1;
        $KysData = json_decode($user["Kysymykset"]);
        $VasData = json_decode($user["Palautus"])
        @endphp
        <!-- tekee palautettamattoman formin ja vaihtaa checkboxit oppilaan vastauksiin -->
        @foreach ($KysData as $key => $values)
        <fieldset class='mb-4'>
            <h3 class='text-lg font-semibold mb-2'>{{$index}}. {{$key}}</h3>
            <div class='mb-1 flex items-center justify-between'>
                <input type='hidden' name='{{$index}}a' value='off'>
                <label for='{{$index}}a' class='mr-2'>{{$values[0]}}</label>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}a' {{ isset($VasData->{$index.'a'}) && $VasData->{$index.'a'} == 'on' ? 'checked' : '' }} disabled>
            </div>
            <div class='mb-1 flex items-center justify-between'>
                <input type='hidden' name='{{$index}}b' value='off'>
                <label for='{{$index}}b' class='mr-2'>{{$values[1]}}</label>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}b' {{ isset($VasData->{$index.'b'}) && $VasData->{$index.'b'} == 'on' ? 'checked' : '' }} disabled>
            </div>
            <div class='mb-1 flex items-center justify-between'>
                <input type='hidden' name='{{$index}}c' value='off'>
                <label for='{{$index}}c' class='mr-2'>{{$values[2]}}</label>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}c' {{ isset($VasData->{$index.'c'}) && $VasData->{$index.'c'} == 'on' ? 'checked' : '' }} disabled>
            </div>
        </fieldset>
        @php
        $index+=1
        @endphp
        @endforeach
        <script>
            window.print();
        </script>
</x-center>