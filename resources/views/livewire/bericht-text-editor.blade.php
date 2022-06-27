<div wire:poll.10s>
    <h1 class="font-semibold text-2xl mt-10 mb-2">Bericht</h1>

    @if(!$bericht->alarm->is_uebung)
        <div class="flex">
            <a class="w-1/2 text-center p-2 @if($bericht->hauptbericht) bg-green-600 text-gray-50 @else bg-green-100 @endif " href="#setHauptbericht" wire:click="setHaupt()">
                Einsatz ohne BF
            </a>
            <a class="w-1/2 text-center p-2 @if(!$bericht->hauptbericht) bg-green-600 text-gray-50 @else bg-green-100 @endif " href="#setNebenbericht" wire:click="setNeben()">
                Einsatz mit BF
            </a>
        </div>
    @endif

    <!--
        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Einsatzende:</div>
        <input type="text" wire:model="bericht.finished_at" class="zis-form-input">
//-->

        @if($bericht->alarm->is_uebung)
        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">besonderheiten zum Übungsdienst:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_2"></textarea>

        @else
        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Lage beim eintreffen:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_1"></textarea>

        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Tätigkeiten der Feuerwehr ( Pflichtfeld ):</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_2"></textarea>

        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Geschädigter:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_3"></textarea>

        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Eigentümer / Hausverwalter / Fahrzeughalter:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_4"></textarea>

        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Eingesetzes Material:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_5"></textarea>

        <div class="font-semibold text-lg mt-4 mb-2 text-gray-700">Sonstiges:</div>
        <textarea class="w-full ring-2 shadow-md p-2" rows="6" wire:model="bericht.text_6"></textarea>
        @endif
</div>
