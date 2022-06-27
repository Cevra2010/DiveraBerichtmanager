@extends("layout.page")

@section("title","Neuen Alarm anlegen")

@section("content")
    @include("layout.error_success")
    <form action="{{ route("bericht.new.store") }}" method="POST">
        @csrf
        <div class="zis-form-group">
            <label for="einsatz_nr" class="zis-form-label">Einsatz-Nr.</label>
            <input type="text" name="einsatz_nr" class="zis-form-input">
        </div>
        <div class="zis-form-group">
            <label for="stichwort" class="zis-form-label">Stichwort</label>
            <input type="text" name="stichwort" class="zis-form-input">
        </div>
        <div class="zis-form-group">
            <label for="bemerkung" class="zis-form-label">Bemerkung / Klingeln bei</label>
            <input type="text" name="bemerkung" class="zis-form-input">
        </div>
        <div class="zis-form-group">
            <label for="address" class="zis-form-label">Adresse*</label>
            <input type="text" name="address" class="zis-form-input">
        </div>

        <button type="submit" class="btn btn-indigo">Alarm zu Berichterstellung anlegen</button>
        <p class="text-sm mt-5">* Pflichtfelder</p>
    </form>
@endsection
