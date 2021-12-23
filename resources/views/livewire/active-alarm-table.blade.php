<div wire:poll.keep-alive.30s>
    @include("layout.error_success")
    <x-headline text="Einsätze ohne abgeschlossenen Einsatzberichte"></x-headline>

    <table class="table">
        <thead>
            <tr>
                <th>E-Nr.</th>
                <th>Stichwort</th>
                <th>Einsatzzeit</th>
                <th>Adresse</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alarms as $alarm)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $alarm->einsatz_nr }}</td>
                    <td>{{ $alarm->stichwort }}</td>
                    <td>
                        @if($alarm->alarm_at)
                        {{ $alarm->alarm_at->format("d.m.Y, H:i") }} Uhr
                        @else
                        -
                        @endif
                    </td>
                    <td>{{ $alarm->address }}</td>
                    <td>
                        @if($alarm->bericht)
                            <a href="{{ route("bericht.show",$alarm->bericht) }}" class="btn btn-indigo">Einsatzbericht ändern</a>
                        @else
                            <a href="{{ route("bericht.create",$alarm) }}" class="btn btn-green">Einsatzbericht anlegen</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
