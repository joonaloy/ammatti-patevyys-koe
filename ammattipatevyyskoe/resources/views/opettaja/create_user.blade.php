<x-center>
    <a class="border border-neutral-400 rounded p-0.5" id="opettaja-link" href="opettaja.php">Opettaja</a>
        <form method="post">
            @csrf
            <div class="w-full max-w-xs border-2 rounded-md p-1" >
                <h1 class="text-xl mb-1">Luo Tunnus</h1>
                <label for="Etunimi">Etunimi</label>
                <input class="border border-neutral-400 mt-2 ml-1 rounded p-0.5" type="text" name="Etunimi" id="Etunimi">
                <label for="Sukunimi">Sukunimi</label>
                <input class="border border-neutral-400 mt-2 ml-1 rounded p-0.5" type="text" name="Sukunimi" id="Sukunimi">
                <label for="Ryhmä">Ryhmä</label>
                <select class="border border-neutral-400 mt-2 ml-1 rounded p-0.5" name="Ryhmä" id="">
                    <option value="kpl">Kappaletavara</option>
                    <option value="hlö">Henkilöliikenne</option>
                </select>
                <button class='border bg-blue-500 text-white border-neutral-400 rounded p-0.5 m-0.5' type="submit">Luo</button>
            </div>
        </form>
</x-center>
