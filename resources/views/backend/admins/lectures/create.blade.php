@extends("backend.layouts.app")

<?php
$action = route('admins::lectures.store');
$method = 'post';
$defaults = [
        'lecture_name' => '',
        'teacher_name' => '',
        'lecture_time' => '',
        'lecture_length' => '',
        'lecture_price' => '',
        'lecture_description' => ''
];
?>

@section("content")
    @include("backend.admins.lectures._form", compact('defaults','action'))
@endsection

@section("js")
    @include('backend.admins.lectures._formJs')
@endsection