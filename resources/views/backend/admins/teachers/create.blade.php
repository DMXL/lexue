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
        'levels' => array(),
        'labels' => array(),
    ];
    $levels = App\Models\Teacher\Level::all();
    $labels = App\Models\Teacher\Label::all();
?>

@section("content")
    @include("backend.admins.teachers._form")
@endsection

@section("js")
    @include('backend.admins.teachers._formJs')
@endsection