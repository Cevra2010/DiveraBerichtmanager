@extends("layout.admin")
@section("title","Personal")

@section("content")
    <livewire:create-personal-form></livewire:create-personal-form>
    <livewire:personal-table></livewire:personal-table>
@endsection
