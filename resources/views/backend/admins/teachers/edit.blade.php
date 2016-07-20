@extends("backend.layouts.app")

<?php
$defaults = [
        'name' => $teacher->name,
        'unit_price' => $teacher->unit_price,
        'teaching_since' => $teacher->teaching_since->year,
        'description' => $teacher->description,
        'levels' => $teacher->levels->pluck('id')->all(),
        'labels' => $teacher->labels->pluck('name')->all(),
];
?>

@section("content")
    @include("backend.admins.teachers._form", compact('defaults'))
@endsection

@section("js")
    @include('backend.admins.teachers._formJs')
@endsection