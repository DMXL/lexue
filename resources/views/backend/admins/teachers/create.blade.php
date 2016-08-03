@extends("backend.layouts.app")

<?php
    $action = route('admins::teachers.store');
    $method = 'post';
    $defaults = [
        'name' => '',
        'email' => '',
        'unit_price' => '',
        'teaching_since' => '',
        'description' => '',
        'levels' => [],
        'labels' => [],
    ];
?>

@section("content")
    @include("backend.admins.teachers._form", compact('defaults','action'))
@endsection

@section("js")
    @include('backend.admins.teachers._formJs')
@endsection