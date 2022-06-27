<!doctype html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield("title") | Intranet | {{ config("einheit.name") }}</title>
    @livewireStyles
</head>
<body class="bg-gray-300">
    @yield("header")


    <div class="container mx-auto mt-10">
        <div class="flex w-full mb-8 items-center">
            <img src="{{ $application_logo }}" class="mr-10 max-h-32">
            <div>
                <p class="text-2xl font-bold">{{ $application_organisation }}</p>
                <p class="text-md font-light">Intranet</p>
            </div>
        </div>
        <div class="w-full bg-gray-50 mb-4">
            <div class="bg-gray-50">
                <div class="w-full border-b-2 border-gray-200">
                    <div class="flex items-center">
                        <div class="w-4 bg-gray-200 h-10">

                        </div>
                        <div class="p-5 font-bold">
                            @yield("title")
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    @yield("content")
                </div>
            </div>
        </div>
        @guest
        <a href="{{ route("admin") }}" class="text-gray-600 text-sm hover:underline">Administration</a>
        @endguest
    </div>
    @livewireScripts
</body>
</html>

