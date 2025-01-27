@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Area</div>
        <div class="card-body">
            <form action="{{ route('updateArea', 'id=' . $get_area->area_id) }}" method="post" id="area_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label>
                            <select name="region" id="area_region" class="form-control form-control-sm select2">
                                @foreach ($get_all_region as $region)
                                    <option value="{{ $region->region_id }}"
                                        {{ $region->region_id == $get_area->area_region_id ? 'selected' : '' }}>
                                        {{ $region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ $get_area->area_name }}"
                                name="area">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="area_remarks" class="form-control form-control-sm" cols="30" rows="1">{{ $get_area->area_remarks }}</textarea>
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
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('area') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $('#area_region').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#area_form').validate({
                rules: {
                    region: {
                        required: true,
                    },
                    area: {
                        required: true,
                        // letterandspace: true,
                        // minlength: 3,
                        // maxlength: 30,
                    },
                    mod_reg_remarks: {
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

        //Add Region on Area page
        $('#area_add_reg_submit').click(function() {
            var region = $('#mod_add_area_region').val();
            var region_remarks = $('#mod_area_reg_remarks').val();
            $.ajax({
                url: 'insert_region',
                method: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'region_remarks': region_remarks,
                },
                success: function(response) {
                    console.log(response);
                    $('#area_region').html(response);
                }
            })
        });
    </script>
@endsection
