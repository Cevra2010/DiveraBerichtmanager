@if($showDeleteConfirmation)
    <div class="absolute top-0 left-0 bg-black bg-opacity-25 w-screen h-screen">
        <div class="flex items-center justify-center h-screen">
            <div class="mx-auto p-5 rounded-md shadow-md bg-gray-50">
                Möchten Sie das Element "<b>{{ $personal->firstname }} {{ $personal->lastname }}</b>" wirklich löschen?

                <div class="flex space-x-2 mt-5">
                    <button type="button" class="btn btn-red" wire:click="confirmDelete">Löschen</button>
                    <button type="button" class="btn btn-green" wire:click="abortDelete">Abbrechen</button>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="mb-10">
    @if($showForm)
        @if($personal->id)
            <x-headline text="Personal bearbeiten"/>
        @else
            <x-headline text="Personal hinzufügen"/>
        @endif
    <form wire:submit.prevent="submit">
        @include("layout.error_success")
        <div class="zis-form-group">
            <label for="firstname" class="zis-form-label">Vorname</label>
            <input class="zis-form-input" wire:model="personal.firstname">
        </div>
        <div class="zis-form-group">
            <label for="lastname" class="zis-form-label">Nachname</label>
            <input class="zis-form-input" wire:model="personal.lastname">
        </div>
        <div class="zis-form-group">
            <label for="gf" class="zis-form-label">Gruppenführer</label>
            <select class="zis-form-input" wire:model="personal.gf">
                <option value="1">Ja</option>
                <option value="0">Nein</option>
            </select>
        </div>
        <div class="zis-form-group">
            <label for="gf" class="zis-form-label">Sichbar für Einsatzdokumentation</label>
            <select class="zis-form-input" wire:model="personal.visible">
                <option value="1">Ja</option>
                <option value="0">Nein</option>
            </select>
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="btn btn-green">Speichern</button>
            <button type="button" wire:click="abort" class="btn btn-red">Abbrechen</button>
            @if($personal->id)
            <button type="button" wire:click="delete" class="btn bg-red-900 text-gray-50">Löschen</button>
            @endif
        </div>
    </form>
    @else
        <button class="btn btn-green" wire:click="addPersonal">Personal hinzufügen</button>
    @endif
</div>
