@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create Main Unit</div>
        <div class="card-body">
            <form action="{{ route('mainUnitStore') }}" method="post" id="main_unit">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Main Unit<span style="color: red">*</span></label>
                            <input type="text" name="main_unit_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="main_unit_remarks" class="form-control form-control-sm" cols="30" rows="1">{{ old('main_unit_remarks') }}</textarea>
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
    <script>
        // Farhad
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('sector') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#main_unit').validate({
                rules: {
                    main_unit_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 30,
                    },
                    main_unit_remarks: {
                        maxlength: 500,
                    },
                }
            });
        });
    </script>
@endsection
