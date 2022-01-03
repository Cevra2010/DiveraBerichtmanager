@extends("layout.admin")

@section("title","Einsatzberichte")

@section("content")

    @if($autodelete)
        <p class="m-4 text-gray-400">Information: Die Berichte werden automatisch 30 Tagen nach Erstellung gelöscht.</p>
        <hr>
    @endif

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
            @php $i=0; @endphp
            @foreach($berichte as $bericht)
                @if(!$bericht->alarm->is_uebung && $bericht->gesamtbericht)
                @php $i++ @endphp
                <tr @if($i%2) class="bg-gray-200" @endif >
                    <td>{{ $bericht->created_at->format("d.m.Y, H:i") }} Uhr</td>
                    <td>{{ $bericht->alarm->einsatz_nr }}</td>
                    <td>{{ $bericht->alarm->address }}</td>
                    <td>{{ $bericht->alarm->stichwort }}</td>
                    <td>
                        <a href="{{ route("admin.bericht.show",$bericht) }}" class="btn btn-indigo">anzeigen</a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
