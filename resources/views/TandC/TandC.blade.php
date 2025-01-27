@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Term and Condition</div>
        <div class="card-body">
            <form action="{{ route('storeTandC') }}" method="post" id="TandC">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Title<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="tandc_title"
                                value="{{ old('tandc_title') }}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Description<span style="color: red">*</span></label>
                            <textarea name="tandc_description" id="tandc_descriptions" class="form-control form-control-sm" cols="30"
                                rows="1" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m">Submit</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    {{-- Farhad --}}
    <script>
        $('document').ready(function() {

            $('#TandC').validate({
                rules: {
                    tandc_title: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                }
            });
        });

        // tinymce.init({ //tinymce(texteditor)
        //     selector: '#tandc_descriptions',
        //     plugins: 'lists',
        //     menubar: "insert",
        //     content_style: 'p {margin: 0px;}',
        //     width: '100%',
        //     height: 140
        // });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#tandc_descriptions'))
            .then(editor => {

                console.error(editor);
            })
            .catch(error => {
                console.error(error);
            });
</script>
    {{-- </script> --}}
@endsection
