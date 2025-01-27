@extends('layouts.app')
@section('styles')
    {{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" /> --}}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Product Category</div>
        <div class="card-body">
            <form action="{{ route('storeCategory') }}" method="post" id="category_form">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Product Group<span style="color: red">*</span></label>
                        <select name="product_group" id="product_group" class="form-control form-control-sm">
                            <option selected disabled hidden>Choose Group</option>
                            @foreach ($product_group as $item)
                                <option value="{{ $item->product_group_id }}">{{ $item->product_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product Category<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="tags" autocomplete="off"
                                data-role="tagsinput" name="category[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m">Submit</button>
                        </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script> --}}
    <script>
        // Farhad
        // $('.date').datepicker({
        //     dateFormat: 'dd-mm-yy'
        // });

        var base = '{{ route('createCategory') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $('#product_group').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#category_form').validate({
                ignore: [],
                rules: {
                    product_group: {
                        required: true,
                    },
                    "category[]": {
                        required: true,
                    },
                }
            });
        });
        $('#tags').tagsinput({
            // 'autocomplete_url': url_to_autocomplete_api,
            // 'autocomplete': { option: value, option: value},
            'height': '100px',
            'width': '300px',
            'interactive': true,
            'defaultText': 'add a tag',
            // 'onAddTag':callback_function,
            // 'onRemoveTag':callback_function,
            // 'onChange' : callback_function,
            'delimiter': [',', ';'], // Or a string with a single delimiter. Ex: ';'
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 0, // if not provided there is no limit
            'placeholderColor': '#666666'
        });
    </script>
@endsection
