
@extends('layouts/app')
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
                    <i class="fas fa-search" style="color: white"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form class="prnt_lst_frm" action="{{ route('funnel') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Companies</label>
                        <select id="companies" class="form-control form-control-sm advance_search" name="companies">
                            <option selected value="0">All</option>
                            @foreach ($all_companies as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $companies ? 'selected' : '' }}>
                                    {{ $item->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Created By</label>
                        <select id="created_by" class="form-control form-control-sm advance_search" name="created_by">
                            <option selected value="0">All</option>
                            @foreach ($all_created_by as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $created_by ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-1">
                        <label for="">Status</label>
                        <select id="status" class="form-control form-control-sm advance_search" name="status">
                            <option selected value="0">All</option>
                            @foreach ($all_status as $item)
                                <option value="{{ $item->sta_id }}" {{ $item->sta_id == $status ? 'selected' : '' }}>
                                    {{ $item->sta_status }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
                    {{-- <div class="col-md-2">
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
                            <div class="col-md-1"><a href="{{ route('funnel') }}" name="refresh" id="refresh"
                                    class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-5 mt-3">
        <div class="card-header">Funnels</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_group')
            {{--        <h1 class="dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
        </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $('.date').datepicker({
            // minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });
        var base = '{{ route('funnel') }}',
            url;
        @include('print.print_script_sh')
        $('document').ready(function() {
            $('#companies').select2();
            $('#created_by').select2();
            $('#funnel_reminder').validate({
                rules: {
                    reminder_date: {
                        required: true,
                    },
                    reminder_remarks: {
                        required: true,
                    },
                }
            });
        });
        // $('.advance_search').change(function () {
        //     var companies = $('#companies option:selected').val();
        //     var status = $('#status option:selected').val();
        //     var created_by = $('#created_by').val();
        //     var from_date = $('#from_date').val();
        //     var to_date = $('#to_date').val();
        //     $.ajax({
        //         url: '/funnel_advance_search',
        //         type: 'get',
        //         data: {
        //             companies: companies,
        //             status: status,
        //             created_by: created_by,
        //             from_date: from_date,
        //             to_date: to_date,
        //         },
        //         dataType: 'json',
        //         success: function(response){
        //             console.log(response);
        //             if (response.count_row != 0){
        //                 $('.dummy_data').hide();
        //                 $('#table_row').show();
        //                 $('#table_row').html(response.table_row);
        //             } else{
        //                 $('#table_row').hide();
        //                 $('.dummy_data').show();
        //             }
        //         },
        //         error: function (XMLHttpRequest) {
        //             console.log(XMLHttpRequest.responseJSON.message);
        //         }
        //     })
        // })
        // (jquery search)
        // $(document).ready(function(){
        //     $("#myInput").on("keyup", function() {
        //         var value = $(this).val().toLowerCase();
        //         $("#myTable tr").filter(function() {
        //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //         });
        //     });
        // });
        // $('.funnel_datetime').datetimepicker({
        //     // minDate: new Date(),
        //     format: 'DD-MM-YYYY HH:mm:ss'
        // });
        $('.funnel_datetime').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('.dataTable').DataTable({ //datatable
            "scrollX": true,
            "paging": false,
            "searching": false,
            "info": false,
            "sScrollXInner": "100%",
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        // for Enabe Disable
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeFunnelStatus',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        });
    </script>
@endsection
