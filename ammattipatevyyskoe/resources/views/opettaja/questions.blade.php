<!-- opettajan kysymys valikko -->
<x-center>
    <a class="border border-neutral-400 rounded p-0.5" id="opettaja-link" href="/opettaja">Opettaja</a>
    <form action="/opettaja/questions/edit" method="post">
        @csrf
        <div class="w-full max-w-xs border-2 rounded-md p-1">
            <label for="Ryhmä">Ryhmä</label>
            <select class="border border-neutral-400 mt-2 ml-1 rounded p-0.5" name="Ryhmä" id="">
                <option value="kpl">Kappaletavara</option>
                <option value="hlö">Henkilöliikenne</option>
            </select>
            <label for="Sarja">Sarja</label>
            <input class="border border-neutral-400 mt-2 ml-1 rounded p-0.5" type="text" name="Sarja" size="1">
            <button class='border bg-blue-500 text-white border-neutral-400 rounded p-0.5 m-0.5' type="submit">Muokkaa</button>
        </div>
    </form>
</x-center>