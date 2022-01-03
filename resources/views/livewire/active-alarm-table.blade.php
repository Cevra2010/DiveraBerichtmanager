<div wire:poll.keep-alive.30s>
    @include("layout.error_success")
    <x-headline text="Einsätze ohne abgeschlossenen Einsatzberichte"></x-headline>
    @if(count($alarms->where("is_uebung",0)))
    <table class="table mb-10">
        <thead>
            <tr>
                <th>E-Nr.</th>
                <th>Erstellt durch</th>
                <th>Stichwort</th>
                <th>Einsatzzeit</th>
                <th>Adresse</th>
                <th class="w-40">Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alarms->where("is_uebung",0) as $alarm)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $alarm->einsatz_nr }}</td>
                    <td>
                        @if($alarm->alarm_id)
                            Divera 24/2
                        @else
                            Nutzer
                        @endif
                    </td>
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
    @else
        <p class="text-gray-400 m-10">Es sind keine offnen Berichte vorhanden.</p>
    @endif

    @if(!\Zis\Ext\SettingsManager\Setting::get('ud_only_logged_in') || auth()->check())
        @if(count($alarms->where("is_uebung",1)))
        <x-headline text="Übungsdienste"></x-headline>
        <table class="table">
            <thead>
            <tr>
                <th class="w-42">Erstellt</th>
                <th>Thema</th>
                <th class="w-40">Aktionen</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alarms->where("is_uebung",1) as $alarm)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $alarm->created_at->format("d.m.Y H:i") }} Uhr</td>
                    <td>{{ $alarm->bemerkung }}</td>
                    <td>
                        @if($alarm->bericht)
                            <a href="{{ route("bericht.show",$alarm->bericht) }}" class="btn btn-indigo">Übungsbericht bearbeiten</a>
                        @else
                            <a href="{{ route("bericht.create",$alarm) }}" class="btn btn-green">Übungsbericht anlegen</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    @endif
</div>
