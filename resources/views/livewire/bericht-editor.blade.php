<div>
    <div class="flex mt-10">
        <a href="#" wire:click="setSection('overview');">
            <div class="p-2 pl-5 pr-5 rounded-tl-md rounded-tr-md border-t border-r border-l border-gray-300 @if($section != "overview") border-b @endif">
                Übersicht
            </div>
        </a>
        <div class="border-b border-gray-300 w-3">

        </div>
        <a href="#" wire:click="setSection('personal');">
            <div class="p-2 pl-5 pr-5 rounded-tl-md rounded-tr-md border-t border-r border-l border-gray-300 @if($section != "personal") border-b @endif">
                Personal
            </div>
        </a>
        <div class="border-b border-gray-300 w-3">

        </div>
        <a href="#" wire:click="setSection('bericht');">
            <div class="p-2 pl-5 pr-5 rounded-tl-md rounded-tr-md border-t border-r border-l border-gray-300 @if($section != "bericht") border-b @endif">
                Bericht
            </div>
        </a>
        <div class="border-b border-gray-300 w-3">

        </div>
        <a href="#" wire:click="setSection('finish');">
            <div class="p-2 pl-5 pr-5 rounded-tl-md rounded-tr-md border-t border-r border-l border-gray-300 @if($section != "finish") border-b @endif">
                Abschluss
            </div>
        </a>
        <div class="border-b border-gray-300 w-full">

        </div>
    </div>

    @switch($section)
        @case("overview")
        <h1 class="font-semibold text-2xl mt-10 mb-2">Übersicht</h1>
            <table class="table">
                <tr>
                    <td class="w-1/4"><b>Einsatznummer</b></td>
                    <td>#{{ $bericht->alarm->einsatz_nr }}</td>
                </tr>
                <tr>
                    <td class="w-1/4"><b>Alarmzeit</b></td>
                    <td>{{ $bericht->alarm->alarm_at->format("d.m.Y") }}</td>
                </tr>
                <tr>
                    <td class="w-1/4"><b>Adresse</b></td>
                    <td>{{ $bericht->alarm->address }}</td>
                </tr>
                <tr>
                    <td class="w-1/4"><b>Stichwort</b></td>
                    <td>{{ $bericht->alarm->stichwort }}</td>
                </tr>
                <tr>
                    <td class="w-1/4"><b>Bemerkung / Klingel bei / OE</b></td>
                    <td>{{ $bericht->alarm->bemerkung }}</td>
                </tr>
            </table>
            @break
        @case("personal")
            @livewire("personal-editor",['bericht' => $bericht])
            @break;
        @case("bericht")
            @livewire("bericht-text-editor",['bericht' => $bericht])
            @break
        @case("finish")
            @livewire("bericht-finish",['bericht' => $bericht])
            @break
        @default
            keine Sektion gefunden
    @endswitch
</div>
