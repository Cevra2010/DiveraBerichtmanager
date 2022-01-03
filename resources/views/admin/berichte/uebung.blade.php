@extends("layout.admin")

@section("title","Übungsberichte")

@section("content")
    <table class="table">
        <thead>
            <tr>
                <th>Erstellt</th>
                <th>Thema</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @foreach($berichte as $bericht)
                @if($bericht->alarm->is_uebung)
                @php $i++ @endphp
                <tr @if($i%2) class="bg-gray-200" @endif>
                    <td>{{ $bericht->created_at->format("d.m.Y, H:i") }} Uhr</td>
                    <td>{{ $bericht->alarm->bemerkung }}</td>
                    <td>
                        <a href="{{ route("admin.bericht.show",$bericht) }}" class="btn btn-indigo">anzeigen</a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
