<div>

    <div class="flex space-x-4 mb-4">
        <a href="#minus" wire:click='subYear' class="w-1/12"><div class="w-full text-center p-3 bg-slate-300 text-slate-500 text-lg rounded-md"><i class="fas fa-arrow-left"></i></div></a>
        <div class="w-10/12 p-3 bg-slate-200 rounded-md text-center text-slate-400 text-lg font-bold">{{ $this->year }}</div>
        <a href="#plus" href="#minus" wire:click='addYear' class="w-1/12"><div class="w-full text-center p-3 bg-slate-300 text-slate-500 text-lg rounded-md"><i class="fas fa-arrow-right"></i></div></a>
    </div>

    <div class="grid grid-cols-2 gap-3">

        <div class="bg-slate-100 rounded-md p-3 text-slate-500 font-light">
            <p class="font-bold text-slate-600">Übersicht {{ $this->year }}</p>
            <hr class="p-2">
            @foreach ($alarms as $alarm)
            <div class="flex @if($loop->odd) bg-slate-200 @endif">
                <div class="p-2 w-1/3">{{ $alarm->created_at->format("d.m.Y") }}</div>
                <div class="p-2">{{ $alarm->bemerkung }}</div>
            </div>
            @endforeach
        </div>

        <div class="bg-slate-100 rounded-md p-3 text-slate-500 font-light">
            <p class="font-bold text-slate-600">Personalstatistik</p>
            <hr class="p-2">

            @foreach($personal as $person)
                <div class="flex @if($loop->odd) bg-slate-200 @endif">
                    <div class="w-1/2 p-2">{{ $person->lastname }}, {{ $person->firstname }}</div>
                    <div class="w-1/2 p-2">{{ $this->countUebung($person) }}</div>
                </div>
            @endforeach

        </div>
    </div>
</div>
