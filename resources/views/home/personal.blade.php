@extends("layout.page")

@section("title","Personal")

@section("content")
    <a href="{{ route("personal.download") }}" class="mb-10 text-blue-700 text-lg ml-3 pb-2"><i class="fas fa-download"></i> Personalliste herunterladen ( pdf )</a>
    <hr class="mt-2 mb-2">
    <table class="table">
        <thead>
            <tr>
                <th>Nachname</th>
                <th>Vorname</th>
                <th>Gruppenführer</th>
                <th>Sichbar für Einsatzbericht</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personal as $person)
                <tr class="@if($loop->odd) bg-gray-200 @endif">
                    <td>{{ $person->lastname }}</td>
                    <td>{{ $person->firstname }}</td>
                    <td>
                        @if($person->gf)
                            <i class="text-green-600 fas fa-check"></i>
                        @else

                        @endif
                    </td>
                    <td>
                        @if($person->visible == 1)
                            <i class="text-green-600 fas fa-check"></i>
                        @else

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
