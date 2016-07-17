@extends("backend.layouts.app")

@section("content")
    @include("backend.admins.teachers.form", [compact('levels')])
@endsection

@section("js")
    <script type="text/javascript">
        var labels = {!! json_encode($labelnames->toArray()) !!};

        var labelnames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: labels
        });

        var teacher_labels = $('#teacher-labels');

        labelnames.initialize();

        teacher_labels.tagsinput({
            typeaheadjs: {
                name: 'labelnames',
                displayKey: 'name',
                valueKey: 'name',
                source: labelnames.ttAdapter()
            },
//            freeInput: false
        });

        $(".twitter-typeahead").css('display', 'inline');

    </script>
@endsection