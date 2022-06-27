<div class="flex mb-5">
    <a href="#" wire:click="checkState">
    <div class="bg-gray-500 text-gray-50 hover:bg-gray-600 p-1 text-sm rounded-tl-md rounded-bl-md ">
        Divera-Zugang prüfen
    </div>
    </a>
    <div class="@if($state === null) bg-gray-400 @elseif($state === false) bg-red-900 @elseif($state === true) bg-green-700 @elseif($state == "connection" ) bg-yellow-400 @endif text-gray-50 p-1 text-sm rounded-tr-md rounded-br-md ">
        @if($state === null) nicht geprüft @elseif($state === false) Fehlgeschlagen. Prüfen Sie ihren API-Schlüssel. @elseif($state === true) erfolgreich @elseif($state == "connection") keine Verbindung zu https://api.divera247.com @endif
    </div>
</div>
