@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Sector</div>
        <div class="card-body">
            <form action="{{ route('updateSector', 'id=' . $get_edit_sector->sector_id) }}" method="post"
                id="Edit_sector_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label>
                            <select name="region" id="sec_region" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Region</option>
                                @foreach ($get_all_region as $region)
                                    <option value="{{ $region->region_id }}"
                                        {{ $region->region_id == $get_edit_sector->sec_region_id ? 'selected' : '' }}>
                                        {{ $region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label>
                            <select name="area" id="sec_area" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Area</option>
                                @foreach ($get_all_area as $area)
                                    <option value="{{ $area->area_id }}"
                                        {{ $area->area_id == $get_edit_sector->sec_area_id ? 'selected' : '' }}>
                                        {{ $area->area_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="sector"
                                value="{{ $get_edit_sector->sec_name }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="sec_remarks" id="" class="form-control form-control-sm" cols="30" rows="1">{{ $get_edit_sector->sec_remarks }}</textarea>
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
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('sector') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $('#sec_region').select2();
            $('#sec_area').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#Edit_sector_form').validate({
                rules: {
                    region: {
                        required: true,
                    },
                    area: {
                        required: true,
                    },
                    sector: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                    sec_remarks: {
                        maxlength: 500,
                    },
                }
            });

            // $('.dataTable').DataTable({         //datatable
            //     "scrollX": true,
            //     "paging": false,
            //     "searching": false,
            //     "info": false,
            //     "sScrollXInner": "100%",
            // });
        });

        //Sector (show area after click on region)
        $('#sec_region').change(function() {
            var region_id = $(this).children('option:selected').val();
            $.ajax({
                url: '{{ route('get_area')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'region_id': region_id
                },
                success: function(response) {
                    $('#sec_area').html(response);
                }
            })
        });
    </script>
@endsection
