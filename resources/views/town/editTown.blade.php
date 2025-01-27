@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Town</div>
        <div class="card-body">
            <form action="{{ route('updateTown', 'id=' . $get_edit_town->town_id) }}" method="post" id="town_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label>
                            <select name="region" id="town_region" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Region</option>
                                @foreach ($get_all_region as $region)
                                    <option value="{{ $region->region_id }}"
                                        {{ $region->region_id == $get_edit_town->town_region_id ? 'selected' : '' }}>
                                        {{ $region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label>
                            <select name="area" id="town_area" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Area</option>
                                @foreach ($get_all_area as $area)
                                    <option value="{{ $area->area_id }}"
                                        {{ $area->area_id == $get_edit_town->town_area_id ? 'selected' : '' }}>
                                        {{ $area->area_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector<span style="color: red">*</span></label>
                            <select name="sector" id="town_sector" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Sector</option>
                                @foreach ($get_all_sector as $sector)
                                    <option value="{{ $sector->sector_id }}"
                                        {{ $sector->sector_id == $get_edit_town->town_sector_id ? 'selected' : '' }}>
                                        {{ $sector->sec_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Town<span style="color: red">*</span></label>
                            <input type="text" name="town" id="town" class="form-control form-control-sm"
                                value="{{ $get_edit_town->town_name }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="remarks" id="" class="form-control form-control-sm" cols="30" rows="1">{{ $get_edit_town->town_remarks }}</textarea>
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
            $('#town_region').select2();
            $('#town_area').select2();
            $('#town_sector').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#town_form').validate({
                rules: {
                    region: {
                        required: true,
                    },
                    area: {
                        required: true,
                    },
                    sector: {
                        required: true,
                    },
                    town: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                    sec_remarks: {
                        maxlength: 500,
                    },
                }
            });
        });
        // (show area after click on region)
        $('#town_region').change(function() {
            var region_id = $(this).children('option:selected').val();
            $.ajax({
                url: '{{ route('get_area')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'region_id': region_id
                },
                success: function(response) {
                    $('#town_area').html(response);
                }
            })
        });

        // (show sector after click on area)
        $('#town_area').change(function() {
            var region_id = $('#town_region').children('option:selected').val();
            var area_id = $('#town_area').children('option:selected').val();
            $.ajax({
                url: '{{ route('get_sector')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'region_id': region_id,
                    'area_id': area_id
                },
                success: function(response) {
                    $('#town_sector').html(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        });
    </script>
@endsection
