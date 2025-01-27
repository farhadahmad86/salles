@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Add Town</div>
        <div class="card-body">
            <form action="{{ route('storeTown') }}" method="post" id="town_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#town_add_region"></button></span>
                            <select name="region" id="town_region" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Region</option>
                                @foreach ($get_all_region as $region)
                                    <option value="{{ $region->region_id }}">{{ $region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#town_add_area"></button></span>
                            <select name="area" id="town_area" class="form-control form-control-sm">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#town_add_sector"></button></span>
                            <select name="sector" id="town_sector" class="form-control form-control-sm">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Town<span style="color: red">*</span></label>
                            <input name="town" type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="town_remarks" id="" class="form-control form-control-sm" cols="30" rows="1"></textarea>
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

    {{--    Town Modal --}}

    {{-- Town Add Region Modal --}}
    <div class="modal fade" id="town_add_region" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                    <form action="" method="post"> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Region</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="off"
                                    id="town_mod_region" name="mod_region">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_reg_remarks" id="town_mod_reg_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <button type="button" data-dismiss="modal" id="town_add_reg_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Town Add Area Modal --}}
    <div class="modal fade" id="town_add_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                    <form action="" method="post"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Region</label><span
                                    class="fa fa-sm fa-redo float-right btn btn-primary" id="refresh_region_2"></span>
                                <select name="mod_region" id="town_mod_region_2" class="form-control form-control-sm">
                                    <option selected disabled hidden>Choose Region</option>
                                    @foreach ($get_all_region as $region)
                                        <option value="{{ $region->region_id }}">{{ $region->reg_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Area</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="off"
                                    id="town_mod_area" name="mod_area">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_area_remarks" id="town_mod_area_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-dismiss="modal" id="town_insert_area_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Town Add Sector Modal --}}
    <div class="modal fade" id="town_add_sector" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                    <form action="" method="post"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Region</label><span
                                    class="fa fa-sm fa-redo float-right btn btn-primary" id="refresh_region_3"></span>
                                <select name="mod_region" id="town_mod_region_3" class="form-control form-control-sm">
                                    <option selected disabled hidden>Choose Region</option>
                                    @foreach ($get_all_region as $region)
                                        <option value="{{ $region->region_id }}">{{ $region->reg_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Area</label><span
                                    class="fa fa-sm fa-redo float-right btn btn-primary" id="refresh_area_2"></span>
                                <select name="mod_area" id="town_mod_area_2" class="form-control form-control-sm">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sector</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="off"
                                    id="town_mod_sector" name="mod_sector">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_sector_remarks" id="town_mod_sector_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-dismiss="modal" id="sec_insert_sector_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // Farhad
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('storeTown') }}',
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
                    town_remarks: {
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
                    console.log(response);
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
                    console.log(response);
                    $('#town_sector').html(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        });

        // show area after click on region on sector modal
        $('#town_mod_region_3').change(function() {
            var region_id = $(this).children('option:selected').val();
            $.ajax({
                url: '{{ route('get_area')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'region_id': region_id
                },
                success: function(response) {
                    $('#town_mod_area_2').html(response);
                }
            })
        });

        // Add Region on town page
        $('#town_add_reg_submit').click(function() {
            var region = $('#town_mod_region').val();
            var region_remarks = $('#town_mod_reg_remarks').val();
            $.ajax({
                url: '{{ route('insert_region')}}',
                type: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'region_remarks': region_remarks,
                },
                success: function(response) {
                    $('#town_region').html(response);
                }
            })
            $('#town_mod_region').val('');
            $('#town_mod_reg_remarks').val('');
        });

        // Add Area on town page
        $('#town_insert_area_submit').click(function() {
            var region = $('#town_mod_region_2 option:selected').val();
            var area = $('#town_mod_area').val();
            var area_remarks = $('#town_mod_area_remarks').val();
            $.ajax({
                url: '{{ route('insert_area')}}',
                method: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'area': area,
                    'area_remarks': area_remarks,
                },
                success: function(response) {
                    $('#town_area').html(response);
                }
            })
            $('#town_mod_region_2').val('');
            $('#town_mod_area').val('');
            $('#town_mod_area_remarks').val('');
        });

        // Add Sector on town page
        $('#sec_insert_sector_submit').click(function() {
            var region = $('#town_mod_region_3 option:selected').val();
            var area = $('#town_mod_area_2').val();
            var sector = $('#town_mod_sector').val();
            var sector_remarks = $('#town_mod_sector_remarks').val();
            $.ajax({
                url: '{{ route('insert_sector')}}',
                method: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'area': area,
                    'sector': sector,
                    'sector_remarks': sector_remarks,
                },
                success: function(response) {
                    $('#town_sector').html(response);
                }
            })
            $('#town_mod_region_3 option:selected').val('');
            $('#town_mod_area_2').val('');
            $('#town_mod_sector').val('');
            $('#town_mod_sector_remarks').val('');
        });

        // refresh region on area modal
        $('#refresh_region_2').click(function() {
            $.ajax({
                url: '{{ route('get_region')}}',
                method: 'GET',
                datatype: 'text',
                success: function(response) {
                    $('#town_mod_region_2').html(response);
                }
            })
        })

        // refresh region on sector modal
        $('#refresh_region_3').click(function() {
            $.ajax({
                url: '{{ route('get_region')}}',
                method: 'GET',
                datatype: 'text',
                success: function(response) {
                    $('#town_mod_region_3').html(response);
                }
            })
        })

        // refresh area on sector modal
        $('#refresh_area_2').click(function() {
            $region_id = $('#town_mod_region_3 option:selected').val();
            $.ajax({
                url: '{{ route('get_area')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'region_id': $region_id,
                },
                success: function(response) {
                    $('#town_mod_area_2').html(response);
                }
            })
        })
    </script>
@endsection
