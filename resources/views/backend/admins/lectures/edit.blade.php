@extends("backend.layouts.app")

<?php
    $action = route('admins::lectures.update', $lecture->id);
    $method = 'put';
    $defaults = [
        'name' => $lecture->name,
        'teacher_id' => $lecture->teacher->id,
        'date' => $lecture->date,
        'start' => $lecture->start,
        'length' => $lecture->length,
        'price' => $lecture->price,
        'description' => $lecture->description
    ];
    $teachers = App\Models\User\Teacher::all();
?>

@section("content")
    @include("backend.admins.lectures._form")
@endsection

@section("js")
    @include('backend.admins.lectures._formJs')
@endsection