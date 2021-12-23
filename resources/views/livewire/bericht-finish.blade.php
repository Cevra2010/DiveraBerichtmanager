<div>
    <h1 class="font-semibold text-2xl mt-10 mb-2">Abschluss</h1>

    @if($this->uebung)
        <form wire:submit.prevent="submit" class="mt-10">
             <button type="submit" class="zis-form-submit">Übungsdienst speichern</button>
        </form>
    @else
        <div class="font-semibold">- Bitte melden Sie sich mit ihren Divera Zugangsdaten an -</div>
        <p class="font-light">
            Die Anmeldung bei Divera dient als digitale Signatur.<br>
            Es wird nur der Divera-Nutzer und <b>nicht</b> das Passwort an den Einsatzbericht übermittelt.
        </p>
        @if(!count($validationErrors))
            @include("layout.error_success")
            <div class="mt-10 bg-green-200 border-green-400 font-light p-4 text-gray-600 rounded-md border-2">
                Berichtprüfung erfolgreich. Bericht kann abgeschlossen werden.
            </div>
            <form wire:submit.prevent="submit" class="mt-10">
                <div class="zis-form-group">
                    <label for="username" class="zis-form-label">E-Mail Adresse</label>
                    <input type="text" name="email" class="zis-form-input" wire:model="email">
                </div>
                <div class="zis-form-group">
                    <label for="password" class="zis-form-label">Passwort</label>
                    <input type="password" name="password" class="zis-form-input" wire:model="password">
                </div>

                <button type="submit" class="zis-form-submit">digital Unterzeichnen & abschließen</button>
            </form>
            @else
            <div class="mt-10 bg-red-200 border-red-400 font-light p-4 text-gray-600 rounded-md border-2">
                <p class="mb-4 font-bold">Bericht kann nicht abgeschlossen werden. Folgende Fehler wurden erkannt:</p>
                @foreach($validationErrors as $error)
                    <p>- {{ $error }}</p>
                @endforeach
            </div>
        @endif
    @endif
</div>
