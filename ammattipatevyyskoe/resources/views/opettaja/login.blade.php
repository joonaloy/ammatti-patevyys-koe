<!-- opettajan kirjautumis sivu -->
<x-center>
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Opettaja Kirjautuminen</h1>
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">Väärä tunnus.</span>
        </div>
        @endforeach
        @endif
        <form method="post">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Tunnus">Tunnus</label>
                <input class="border-2 border-gray-300 rounded-full w-full p-2 mb-4 focus:ring focus:border-blue-500"
                    type="password" name="Tunnus" id="Tunnus"
                    value="<?= htmlspecialchars($_POST["Tunnus"] ?? "") ?>" required>
            </div>
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out"
                type="submit">Kirjaudu</button>
        </form>
        <div class="mt-4 text-center">
            <a href="/koe/login" class="text-blue-500 hover:underline">Olen opiskelija</a>
        </div>
    </div>
</x-center>