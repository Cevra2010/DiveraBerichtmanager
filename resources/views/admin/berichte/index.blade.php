@extends("layout.admin")

@section("title","Einsatzberichte")

@section("content")
    <table class="table">
        <thead>
            <tr>
                <th>Erstellt</th>
                <th>E-Nr.</th>
                <th>Adresse</th>
                <th>Stichwort</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($berichte as $bericht)
                <tr>
                    <td>{{ $bericht->created_at->format("d.m.Y, H:i") }} Uhr</td>
                    <td>{{ $bericht->alarm->einsatz_nr }}</td>
                    <td>{{ $bericht->alarm->address }}</td>
                    <td>{{ $bericht->alarm->stichwort }}</td>
                    <td>
                        <a href="{{ route("admin.bericht.show",$bericht) }}" class="btn btn-indigo">anzeigen</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
