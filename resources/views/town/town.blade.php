@extends('layouts.app')
@section('styles')
    <style>
        .select2.select2-container {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-search" style="color: black"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form class="prnt_lst_frm" action="{{ route('town') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Region</label>
                        <select id="region" class="form-control form-control-sm advance_search" name="region">
                            <option selected value="0">All</option>
                            @foreach ($all_region as $item)
                                <option value="{{ $item->region_id }}" {{ $item->region_id == $region ? 'selected' : '' }}>
                                    {{ $item->reg_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Area</label>
                        <select id="area" class="form-control form-control-sm advance_search" name="area">
                            <option selected value="0">All</option>
                            @foreach ($all_area as $item)
                                <option value="{{ $item->area_id }}" {{ $item->area_id == $area ? 'selected' : '' }}>
                                    {{ $item->area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Sector</label>
                        <select id="sector" class="form-control form-control-sm advance_search" name="sector">
                            <option selected value="0">All</option>
                            @foreach ($all_sector as $item)
                                <option value="{{ $item->sector_id }}" {{ $item->sector_id == $sector ? 'selected' : '' }}>
                                    {{ $item->sec_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Town</label>
                        <select id="town" class="form-control form-control-sm advance_search" name="town">
                            <option selected value="0">All</option>
                                                       @foreach ($all_town as $item)
                                                           <option value="{{$item->town_id}}" {{$item->town_id == $town ? 'selected' : ''}}>{{$item->town_name}}</option>
                                                       @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="">Created By</label>
                        <select id="created_by" class="form-control form-control-sm advance_search" name="created_by">
                            <option selected value="0">All</option>
                            @foreach ($all_created_by as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $created_by ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                            value="{{ $from_date }}" id="from_date" placeholder="Choose...">
                    </div>
                    <div class="col-md-1">
                        <label for="">To Date</label>
                        <input type="text" name="to_date" class="form-control date advance_search form-control-sm"
                            value="{{ $to_date }}" id="to_date" placeholder="Choose...">
                    </div>
                    {{-- <div class="col-md-1">
                        <label for="">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm advance_search"
                            id="search" value="{{ $search }}">
                    </div> --}}
                </div>
                <div class="row mt-3 mb-3">
                    <div class="filter_buttons">
                        <input type="submit" class="btn btn-primary btn-sm" value="Search">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="prnt_cus('pdf')">Print</button>
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column"
                                x-placement="bottom-end">
                                <button type="button" class="dropdown-item" id=""
                                    onclick="prnt_cus('download_pdf')">
                                    <i class="fa fa-print"></i> Download PDF
                                </button>
                                {{-- <button type="button" class="dropdown-item" onclick="prnt_cus('download_excel')">
                                    <i class="fa fa-file-excel-o"></i> Excel Sheet
                                </button> --}}
                            </div>
                            <div class="col-md-1"><a href="{{ route('town') }}" name="refresh" id="refresh"
                                    class="btn btn-primary">
                                    <i class="fas fa-sync"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4 mb-5">
        <div class="card-header">Town</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_town')
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('town') }}',
            url;
        @include('print.print_script_sh')

        // $('document').ready(function () {
        //     $.validator.addMethod("letterandspace", function(value, element) {
        //         return this.optional( element ) || /^[a-z\s]+$/i.test(value);
        //     }, "Only alphabetical characters");
        //     $('#sector_form').validate({
        //         rules: {
        //             region: {
        //                 required: true,
        //             },
        //             area: {
        //                 required: true,
        //             },
        //             sector: {
        //                 required: true,
        //                 letterandspace: true,
        //                 minlength: 3,
        //                 maxlength: 30,
        //             },
        //             sec_remarks: {
        //                 maxlength: 500,
        //             },
        //         }
        //     });
        //
        //     $('.dataTable').DataTable({         //datatable
        //         "scrollX": true,
        //         "paging": false,
        //         "searching": false,
        //         "info": false,
        //         "sScrollXInner": "100%",
        //     });
        // });
        $('document').ready(function() {
            $('#region').select2();
            $('#area').select2();
            $('#sector').select2();
            $('#town').select2();
            $('#created_by').select2();
        });

        //Sector (show area after click on region)
        $('#sec_region').change(function() {
            var value = $(this).children('option:selected').val();
            $.ajax({
                url: 'get_area',
                method: 'GET',
                datatype: 'text',
                data: {
                    'value': value
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
                url: 'insert_region',
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
        });
        // Add Area on sector page
        $('#sec_insert_area_submit').click(function() {
            var previous_region = $('#sec_region option:selected').val();
            var region = $('#sec_mod_region_2 option:selected').val();
            var area = $('#sec_mod_area').val();
            var area_remarks = $('#sec_mod_area_remarks').val();
            // $('#sec_mod_area').val('');
            // $('#sec_mod_area_remarks').val('');
            $.ajax({
                url: 'insert_area',
                method: 'get',
                datatype: 'text',
                data: {
                    'previous_region': previous_region,
                    'region': region,
                    'area': area,
                    'area_remarks': area_remarks,
                },
                success: function(response) {
                    console.log(response);
                    $('#sec_area').html(response);
                }
            })
        });
    </script>
@endsection
