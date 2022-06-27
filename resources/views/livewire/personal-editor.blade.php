<div wire:poll.10s>
    <h1 class="font-semibold text-2xl mt-10 mb-2">Personal</h1>
    @include("layout.error_success")
    <div class="flex">
        <table class="table">
            <thead class="absolute sticky top-0 bg-white">
                <tr>
                    <th class="text-left">Name</th>
                    @foreach($positionen as $position)
                        <th class="w-30 text-center">{{ $position->name }}</th>
                    @endforeach
                    @foreach($funktionen as $funktion)
                        <th class="text-center">{{ $funktion->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($personal as $person)
                    <tr @if($loop->odd) class="bg-gray-200" @endif>
                        <td class="w-64">{{ $person->lastname }}, {{ $person->firstname }}</td>
                        @foreach($positionen as $position)
                            <td class="w-12 @if($loop->parent->odd) bg-red-200 @else bg-red-100 @endif">
                                @if($relationships->where('personal_id',$person->id)->where('position_id',$position->id)->count())
                                    <a href="#setPosition" wire:click="unsetPosition('{{ $person->id }}','{{ $position->id }}');">
                                        <div class="w-full h-8 bg-green-600">
                                            &nbsp;
                                        </div>
                                    </a>
                                @else
                                    <a href="#setPosition" wire:click="setPosition('{{ $person->id }}','{{ $position->id }}');">
                                        <div class="w-full h-8 bg-gray-400">
                                            &nbsp;
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endforeach
                        @foreach($funktionen as $funktion)
                            <td>
                                @if($relationships->where('personal_id',$person->id)->where('funktion_id',$funktion->id)->count())
                                    <a href="#unsetFunktion" wire:click="unsetFunktion('{{ $person->id }}')">
                                        <div class="w-full h-8 bg-green-600">
                                            &nbsp;
                                        </div>
                                    </a>
                                @else
                                    <a href="#setFunktion" wire:click="setFunktion('{{ $person->id }}','{{ $funktion->id }}')">
                                        <div class="w-full h-8 bg-gray-400">
                                            &nbsp;
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
