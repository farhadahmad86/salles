@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Sector</div>
        <div class="card-body">
            <form action="{{ route('storeSector') }}" method="post" id="sector_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#sec_add_region"></button></span>
                            <select name="region" id="sec_region" class="form-control form-control-sm select2">
                                <option selected disabled hidden>Choose Region</option>
                                @foreach ($get_all_region as $region1)
                                    <option value="{{ $region1->region_id }}">{{ $region1->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#sec_add_area"></button></span>
                            <select name="area" id="sec_area" class="form-control form-control-sm select2">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="sector">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="sec_remarks" id="" class="form-control form-control-sm" cols="30" rows="1"></textarea>
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

    {{--    Sector Modal --}}

    {{-- Sector Add Region Modal --}}
    <div class="modal fade" id="sec_add_region" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                    <form action="" method="post"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Region</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="off"
                                    id="sec_mod_region" name="mod_region">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_reg_remarks" id="sec_mod_reg_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-dismiss="modal" id="sec_add_reg_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Sector Add Area Modal --}}
    <div class="modal fade" id="sec_add_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Area</h5>
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
                                    class="fa fa-redo float-right btn btn-primary btn-sm" id="refresh_region_2"></span>
                                <select name="mod_region" id="sec_mod_region_2" class="form-control form-control-sm">
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
                                    id="sec_mod_area" name="mod_area">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_area_remarks" id="sec_mod_area_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-dismiss="modal" id="sec_insert_area_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
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
            $('#sector_form').validate({
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


        // (show area after click on region)
        $('#sec_region').change(function() {
            var region_id = $(this).children('option:selected').val();
            $.ajax({
                url: '{{ route('get_area')}}',
                type: 'get',
                datatype: 'text',
                data: {
                    'region_id': region_id
                },
                success: function(response) {
                    $('#sec_area').html(response);
                }
            })
        });

        // Add Region on sector page
        $('#sec_add_reg_submit').click(function() {
            var region = $('#sec_mod_region').val();
            var region_remarks = $('#sec_mod_reg_remarks').val();
            $.ajax({
                url: '{{ route('insert_region')}}',
                method: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'region_remarks': region_remarks,
                },
                success: function(response) {
                    $('#sec_region').html(response);
                }
            })
            $('#sec_mod_region').val('');
            $('#sec_mod_reg_remarks').val('');
        });

        // Add Area on sector page
        $('#sec_insert_area_submit').click(function() {
            // var previous_region = $('#sec_region option:selected').val();
            var region = $('#sec_mod_region_2 option:selected').val();
            var area = $('#sec_mod_area').val();
            var area_remarks = $('#sec_mod_area_remarks').val();
            $.ajax({
                url: '{{ route('insert_area')}}',
                method: 'get',
                datatype: 'text',
                data: {
                    // 'previous_region': previous_region,
                    'region': region,
                    'area': area,
                    'area_remarks': area_remarks,
                },
                success: function(response) {
                    console.log(response);
                    $('#sec_area').html(response);
                }
            })
            $('#sec_mod_area').val('');
            $('#sec_mod_area_remarks').val('');
        });

        // refresh region on area modal
        $('#refresh_region_2').click(function() {
            $.ajax({
                url: '{{ route('get_region')}}',
                method: 'GET',
                datatype: 'text',
                success: function(response) {
                    $('#sec_mod_region_2').html(response);
                }
            })
        })
    </script>
@endsection
