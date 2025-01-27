@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Region</div>
        <div class="card-body">
            <form action="{{ route('storeRegion') }}" method="post" id="region_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm " name="region">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="reg_remarks" class="form-control form-control-sm " cols="30" rows="1"></textarea>
                        </div>
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
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('region') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#region_form').validate({
                errorClass: 'error',
                rules: {
                    region: {
                        required: true,
                        // letterandspace: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                    reg_remarks: {
                        maxlength: 500,
                    }
                }
            });

            $('.dataTable').DataTable({ //datatable
                "scrollX": true,
                "paging": false,
                "searching": false,
                "info": false,
                "sScrollXInner": "100%",
            });
        });
    </script>
@endsection
