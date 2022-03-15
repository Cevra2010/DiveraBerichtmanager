@extends("layout.admin")

@section("title","Bestätigung erstellen")

@section("content")
    @livewire("einsatz-info",['bericht' => $bericht])
@endsection
