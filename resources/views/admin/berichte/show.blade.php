@extends("layout.admin")

@section("title","Einsatzberichte")

@section("content")
    {!! nl2br($bericht->gesamtbericht) !!}
@endsection
