@extends("layout.page")

@section("title","Übersicht")

@section("content")
    <a href="{{ route("bericht.new") }}" class="btn btn-red mb-5">Neuen Alarm anlegen</a>
    @if(\Zis\Ext\SettingsManager\Setting::get('ud_only_logged_in'))
        @if(auth()->check())
            <a href="{{ route("uebung.create") }}" class="btn btn-indigo mb-5">Neuen Übungsdienst anlegen</a>
        @endif
    @else
        <a href="{{ route("uebung.create") }}" class="btn btn-indigo mb-5">Neuen Übungsdienst anlegen</a>
    @endif


    <livewire:active-alarm-table></livewire:active-alarm-table>
@endsection
