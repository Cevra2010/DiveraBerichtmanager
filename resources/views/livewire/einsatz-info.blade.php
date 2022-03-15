<div>
    @if(!$personal)
        <p class="p-2 bg-indigo-100">Bitte wählen Sie die betreffende Person aus</p>
        @foreach($bericht->personal as $personal)
            <ul>
                <a href="#" wire:click='setPersonal({{ $personal->id }})'><li class="p-2 w-full bg-gray-100 hover:bg-gray-200 my-2">{{ $personal->firstname }}  {{ $personal->lastname }}</li></a>
            </ul>
        @endforeach
    @else
        <button class="mb-3 btn btn-red" wire:click='abort'>Schließen</button>
        <hr>
        <h1 class="mt-2 mb-4 text-lg font-bold">Bestätigung erstellen für: <span class="font-light">{{ $personal->firstname }} {{ $personal->lastname }}</span></h1>

        @include("layout.error_success")

        <div class="zis-form-group">
            <label class="zis-form-label">Einsatznummer</label>
            <input type="text" wire:model='einsatznummer' class="zis-form-input">
        </div>

        <div class="zis-form-group">
            <label class="zis-form-label">Alarmzeitpunkt</label>
            <input type="text" wire:model='alarm_at' class="zis-form-input">
        </div>

        <div class="zis-form-group">
            <label class="zis-form-label">Einsatzende</label>
            <input type="text" wire:model='alarm_end_at' class="zis-form-input">
        </div>

        <div class="zis-form-group">
            <label class="zis-form-label">Empfänger</label>
            <textarea type="text" wire:model='adressat' class="zis-form-input" rows="4"></textarea>
        </div>

        <button class="btn btn-green" wire:click='generate'>Bestätigung erstellen</button>
    @endif
</div>
