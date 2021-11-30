@extends("layout.app")

@section("title","Anmelden")

@section("content")
    <div class="w-1/3 mx-auto mt-10 mb-14">
        <div class="text-2xl text-gray-700 text-center w-full rounded-md mb-10">
            Administrationsbereich
            <p class="text-sm text-gray-500">Bitte anmelden...</p>
        </div>
        <div class="mx-auto">
            <form action="{{ route("login.submit") }}" method="POST">
                @csrf
                @include("layout.error_success")
                <div class="flex items-center space-x-5">
                    <label for="password" class="text-gray-700">Passwort:</label>
                    <input type="password" class="p-2 w-full border-gray-200 border rounded-md" name="password" />
                </div>
                <button type="submit" class="bg-gray-800 text-gray-50 shadow-md p-2 w-full mt-5">Anmelden</button>
            </form>
        </div>
    </div>
@endsection
