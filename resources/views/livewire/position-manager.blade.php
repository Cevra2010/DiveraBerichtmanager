<div>
    <x-headline text="Position hinzufügen"/>
    <livewire:create-position-form></livewire:create-position-form>

    <x-headline text="Positionen"/>

    @if($positionen->count())
        <table class="table">
            <thead>
            <tr>
                <th class="w-1/2">Position</th>
                <th></th>
                <th></th>
                <th class="w-1/2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($positionen as $position)
                <tr class="@if($loop->odd) bg-gray-200 @endif">
                    <td>{{ $position->name }}</td>
                    <td>
                        @if(!$loop->first)
                            <button class="bg-gray-500 text-gray-50 p-1 pl-5 pr-5" wire:click="orderDown({{ $position->id }})"><i class="fas fa-arrow-up"></i></button>
                        @endif
                    </td>
                    <td>
                        @if(!$loop->last)
                            <button class="bg-gray-500 text-gray-50 p-1  pl-5 pr-5" wire:click="orderUp({{ $position->id }})"><i class="fas fa-arrow-down"></i></button>
                        @endif
                    </td>
                    <td class="text-right">
                        <button class="btn btn-red" wire:click="delete({{ $position->id }})">löschen</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="text-gray-700">
            Sie haben noch keine Positionen erstellt.
        </div>
    @endif
</div>
