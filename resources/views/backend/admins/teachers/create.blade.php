@extends("backend.layouts.app")

@section("content")
    @include("backend.admins.teachers._form")
@endsection

@section("js")
    @include('backend.admins.teachers._formJs')
@endsection