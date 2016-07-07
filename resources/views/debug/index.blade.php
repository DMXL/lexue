@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($teachers as $teacher)
            <h4>{{ $teacher->name }}</h4>
            <p>{{ $teacher->description }}</p>
        @endforeach
    </div>
@endsection
