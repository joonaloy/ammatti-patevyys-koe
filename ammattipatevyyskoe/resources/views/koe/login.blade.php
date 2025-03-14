<x-layout>
    <h1 class="text-3xl font-bold text-center mb-6">Kirjautuminen</h1>
    <form method="post">
        @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Tunnus">Tunnus</label>
                <input class="border-2 border-gray-300 rounded-full w-full p-2 mb-4 focus:ring focus:border-blue-500"
                       type="text" name="Tunnus" id="Tunnus"
                       value="<?= htmlspecialchars($_POST["Tunnus"] ?? "") ?>" required>
            </div>
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out"
                    type="submit">Kirjaudu</button>
        </form>
        @if ($errors->any())
        @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
    @endif
</x-layout>
