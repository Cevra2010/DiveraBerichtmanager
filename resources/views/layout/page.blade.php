@extends("layout.app")

@section("header")

    <div class="w-full items-center justify-center flex bg-indigo-900 text-gray-50 shadow-md">
        <a href="{{ route("index") }}">
            <div class="p-4 hover:bg-gray-500 hover:text-gray-50">
                Übersicht
            </div>
        </a>
        <a href="{{ route("personal") }}">
            <div class="p-4 hover:bg-gray-500 hover:text-gray-50">
                Personal
            </div>
        </a>
        @auth
        <a href="{{ route("printer") }}">
            <div class="p-4 hover:bg-gray-500 hover:text-gray-50">
                Druckvorlagen
            </div>
        </a>
        <a href="#" onclick="document.getElementById('logoutForm').submit();">
            <div class="p-4 hover:bg-red-700 bg-red-500 hover:text-gray-50">
                Abmelden
            </div>
        </a>
        <form action="{{ route("logout") }}" id="logoutForm" method="POST">
            @csrf
        </form>
        <a href="{{ route("admin") }}">
            <div class="p-4 hover:bg-gray-500 hover:text-gray-50">
                [ Administartionsbereich ]
            </div>
        </a>
        @endauth
    </div>
@endsection
