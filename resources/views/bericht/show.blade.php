@extends("layout.page")

@section("title","Einsatzbericht: ".$bericht->alarm->address)

@section("content")
    @livewire("bericht-editor",['bericht' => $bericht])
@endsection
