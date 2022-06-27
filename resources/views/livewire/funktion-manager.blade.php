<div>
    <x-headline text="Funktion hinzufügen"/>
    <livewire:create-funktion-form></livewire:create-funktion-form>

    <x-headline text="Funktionen"/>

    @if($funktionen->count())
    <table class="table">
        <thead>
            <tr>
                <th class="w-1/2">Funktion</th>
                <th></th>
                <th></th>
                <th class="w-1/2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($funktionen as $funktion)
                <tr class="@if($loop->odd) bg-gray-200 @endif">
                    <td>{{ $funktion->name }}</td>
                    <td>
                        @if(!$loop->first)
                            <button class="bg-gray-500 text-gray-50 p-1 pl-5 pr-5" wire:click="orderDown({{ $funktion->id }})"><i class="fas fa-arrow-up"></i></button>
                        @endif
                    </td>
                    <td>
                        @if(!$loop->last)
                            <button class="bg-gray-500 text-gray-50 p-1  pl-5 pr-5" wire:click="orderUp({{ $funktion->id }})"><i class="fas fa-arrow-down"></i></button>
                        @endif
                    </td>
                    <td class="text-right">
                        <button class="btn btn-red" wire:click="delete({{ $funktion->id }})">löschen</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="text-gray-700">
            Sie haben noch keine Funktionen erstellt.
        </div>
    @endif
</div>
