@extends("backend.layouts.app")

<?php
$action = route('admins::lectures.store');
$method = 'post';
$defaults = [
        'name' => '',
        'teacher_id' => '',
        'date' => '',
        'start' => '',
        'length' => '',
        'price' => '',
        'description' => ''
];
?>

@section("content")
    @include("backend.admins.lectures._form", compact('defaults','action'))
@endsection

@section("js")
    @include('backend.admins.lectures._formJs')
@endsection