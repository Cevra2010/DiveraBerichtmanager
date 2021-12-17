<div>

    <x-headline text="Personalübersicht"/>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Gruppenführer</th>
                <th>Sichtbar</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personal as $person)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $person->id }}</td>
                    <td>{{ $person->firstname }}</td>
                    <td>{{ $person->lastname }}</td>
                    <td>
                        @if($person->gf)
                            <i class="text-green-600 fas fa-check"></i>
                        @else

                        @endif
                    </td>
                    <td>
                        @if($person->visible)
                            Ja
                        @else
                            Nein
                        @endif
                    </td>
                    <td>
                        <a href="#" class="hover:underline" wire:click="$emit('select_personal','{{ $person->id }} }}')">auswählen</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
