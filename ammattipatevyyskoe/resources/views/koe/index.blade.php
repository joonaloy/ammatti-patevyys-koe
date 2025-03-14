<x-layout>
    <h1>koe</h1>
    <form action="/koe/result" method="POST">
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
</x-layout>
