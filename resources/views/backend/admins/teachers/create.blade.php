@extends('backend.layouts.app')

@section('content')
    @include('backend.admins.teachers.form')
@endsection

@section('js')
    <script type="text/javascript">
        $("#teacher-levels").select2();
        $("#teacher-labels").select2();

        /*$("#teacher-years").TouchSpin({
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });*/
    </script>
@endsection