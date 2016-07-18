@extends("backend.layouts.app")

@section("content")
    @include("backend.admins.teachers._form")
@endsection

@section("js")
    <script type="text/javascript">
        $(function() {
            $("#teacher-labels").selectize({
                create: true
            });
        });
    </script>
@endsection