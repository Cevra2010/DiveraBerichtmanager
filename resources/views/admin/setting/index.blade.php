@extends("layout.admin")

@section("title","Einstellungen")

@section("content")

    @include("layout.error_success")

    <x-headline text="Allgemeine Einstellungen"/>
    <livewire:check-divera-state></livewire:check-divera-state>
    <div class="mb-10">
        <form action="{{ route("admin.setting.store") }}" method="POST">
            @csrf
            <div class="zis-form-group">
                <label class="zis-form-label" for="organisation">Organisation</label>
                <input type="text" name="organisation" class="zis-form-input" value="{{ old("organisation",$organisation) }}">
            </div>
            <div class="zis-form-group">
                <label class="zis-form-label" for="alarm_api_key">Divera Alarm API-Key</label>
                <input type="text" name="alarm_api_key" class="zis-form-input" value="{{ old("alarm_api_key",$alarm_api_key) }}">
            </div>
            <button type="submit" class="btn btn-indigo">Einstellungen speichern</button>
        </form>
    </div>

    <x-headline text="Passwort ändern"/>
    <div class="mb-10">
        <form action="{{ route("admin.setting.password.store") }}" method="POST">
            @csrf
            <div class="zis-form-group">
                <label class="zis-form-label" for="password">Passwort</label>
                <input type="password" name="password" class="zis-form-input">
            </div>
            <div class="zis-form-group">
                <label class="zis-form-label" for="organisation">Passwort wdh.</label>
                <input type="password" name="password_confirmation" class="zis-form-input">
            </div>
            <button type="submit" class="btn btn-indigo">Passwort speichern</button>
        </form>
    </div>

    <x-headline text="Logo"/>
    <div class="flex space-x-10">
        <div>
        <div class="p-5 bg-gray-200 mb-2">
            <img src="{{ $application_logo }}" class="mr-10 w-full">
        </div>
        <form action="{{ route("admin.setting.logo.reset") }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-red text-sm p-1">Logo zurücksetzen</button>
        </form>
        </div>
        <div>
            <form action="{{ route("admin.setting.logo") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="zis-form-group">
                    <label class="zis-form-label" for="logo">Logo-Datei</label>
                    <input type="file" name="logo" class="zis-form-input">
                </div>
                <button type="submit" class="btn btn-indigo">Logo speichern</button>
            </form>
        </div>
    </div>
@endsection
