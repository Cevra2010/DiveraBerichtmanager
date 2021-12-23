@extends("layout.page")

@section("title","Übersicht")

@section("content")
    <a href="{{ route("bericht.new") }}" class="btn btn-red mb-5">Neuen Alarm anlegen</a>

    <livewire:active-alarm-table></livewire:active-alarm-table>
@endsection
