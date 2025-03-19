<x-clean>
    <form action="/opettaja/questions" method="POST">
        @csrf
        <input type='hidden' name='R' value='{{$Ryhmä}}'>
        <input type='hidden' name='S' value='{{$Sarja}}'>
        @php
            $index = 1;
            $KysData = json_decode($KysData);
            $VasData = json_decode($VasData)
        @endphp
        @foreach ($KysData as $key => $values)
            <fieldset class='mb-4'>
                <input type='text' class='border border-neutral-400 mt-2 ml-1 rounded p-0.5' name='key{{$index}}' value = '{{$key}}' size='20'></input>

                <input type='hidden' name='{{$index}}a' value='off'>
                <input type='text' class='border border-neutral-400 mt-2 ml-1 rounded p-0.5' name='key{{$index}}a' value='{{$values[0]}}' size='12'></input>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}a' {{ isset($VasData->{$index.'a'}) && $VasData->{$index.'a'} == 'on' ? 'checked' : '' }}>

                <input type='hidden' name='{{$index}}b' value='off'>
                <input type='text' class='border border-neutral-400 mt-2 ml-1 rounded p-0.5' name='key{{$index}}b' value='{{$values[1]}}' size='12'></input>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}b' {{ isset($VasData->{$index.'b'}) && $VasData->{$index.'b'} == 'on' ? 'checked' : '' }} >

                <input type='hidden' name='{{$index}}c' value='off'>
                <input type='text' class='border border-neutral-400 mt-2 ml-1 rounded p-0.5' name='key{{$index}}c' value='{{$values[2]}}' size='12'></input>
                <input class='custom-checkbox' type='checkbox' name='{{$index}}c' {{ isset($VasData->{$index.'c'}) && $VasData->{$index.'c'} == 'on' ? 'checked' : '' }} >

                </fieldset>
                @php
                    $index+=1
                @endphp
        @endforeach
        <button class='border bg-blue-500 text-white border-neutral-400 rounded p-0.5 m-0.5' type="submit">Lähetä</button> 
    </form>
</x-clean>
