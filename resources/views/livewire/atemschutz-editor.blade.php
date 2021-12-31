<div>
    @if($atemschutz != null)
        <p class="text-gray-500 text-l font-bold mt-4 mb-2">Person: {{ $atemschutz->personal->lastname }}, {{ $atemschutz->personal->firstname }}</p>
        <div class="zis-form-group">
            <label class="zis-form-label">Tragezeit in min</label>
            <input type="text" class="zis-form-input" wire:model="atemschutz.minutes">
        </div>
        <div class="zis-form-group">
            <label class="zis-form-label">Geräte-Nr.</label>
            <input type="text" class="zis-form-input" wire:model="atemschutz.geraet_nr">
        </div>
        <div class="zis-form-group">
            <label class="zis-form-label">Tätigkeit</label>
            <input type="text" class="zis-form-input" wire:model="atemschutz.tatigkeit">
        </div>
        <button class="btn btn-indigo" wire:click="submit">Speichern</button>
    @endif
</div>
