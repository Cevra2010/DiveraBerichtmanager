@extends("layout.admin")

@section("title","Einsatzberichte")

@section("content")

    <p>
        <a href="{{ route("admin.bericht.bestaetigung",$bericht) }}" class="btn btn-green mb-3">Bestätigung für die Teilnahme erstellen</a>
    </p>

    {!! nl2br($bericht->gesamtbericht) !!}
@endsection
