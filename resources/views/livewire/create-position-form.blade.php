<div class="mb-5">
    @include("layout.error_success")
    <form wire:submit.prevent="submit">
        <div class="zis-form-group">
            <label for="name" class="zis-form-label">Name</label>
            <input type="text" class="zis-form-input" wire:model="name">
        </div>
        <button type="submit" class="btn btn-indigo">Hinzufügen</button>
    </form>
</div>
