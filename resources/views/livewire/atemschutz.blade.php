<div>
    <h1 class="font-semibold text-2xl mt-10 mb-2">Atemschutz</h1>

    @livewire("atemschutz-editor")

    <p class="mt-10 mb-2 text-l font-bold">Personal unter Atemschutz</p>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Tragzeit</th>
                <th>Geräte-Nr.</th>
                <th>Tätigkeit</th>
                <th>Aktionen</th>

            </tr>
        </thead>
        <tbody>
            @foreach($atemschutz as $atem)
                <tr class="@if($loop->odd) bg-gray-200 @endif">
                    <td>{{ $atem->personal->lastname }}, {{ $atem->personal->firstname }}</td>
                    <td>{{ $atem->minutes }}</td>
                    <td>{{ $atem->geraet_nr }}</td>
                    <td>{{ $atem->tatigkeit }}</td>
                    <td>
                        <button class="btn btn-indigo" wire:click="$emit('openAtem','{{ $atem->id }}')">bearbeiten</button>
                        <button class="btn btn-red" wire:click="delAtemschutz({{ $atem->id }})">löschen</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$atemschutz->count())
        <p class="m-6 text-gray-500 text-l font-light">
            Es sind keine Personen unter Atemschutz registriert.
        </p>
    @endif

    <p class="mt-12 mb-2 text-l font-bold">Verfügbares Personal</p>
    <hr>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bericht->personal as $personal)
            @if(!$bericht->atemschutzExists($personal))
            <tr>
                <td class="w-20">
                    <button class="btn btn-green" wire:click="atemschutzAdd({{ $personal->id }})"><i class="fa fa-plus"></i></button>
                </td>
                <td>{{ $personal->lastname }}, {{ $personal->firstname }}</td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>


</div>
