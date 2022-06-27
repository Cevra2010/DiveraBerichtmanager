@extends("layout.page")

@section("title","Neuen Übungsdienst anlegen")

@section("content")
    @include("layout.error_success")
    <form action="{{ route("uebung.store") }}" method="POST">
        @csrf
        <div class="zis-form-group">
            <label for="thema" class="zis-form-label">Thema*</label>
            <input type="text" name="thema" class="zis-form-input">
        </div>

        <button type="submit" class="btn btn-indigo">Übungsdienst anlegen</button>
        <p class="text-sm mt-5">* Pflichtfelder</p>
    </form>
@endsection
