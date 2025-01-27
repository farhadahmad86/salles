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
                    <i class="fas fa-search" style="color: white"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form class="prnt_lst_frm" action="{{ route('schedule_show') }}">
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
                    <div class="col-md-2">
                        <label for="">Visit Type</label>
                        <select id="visit_type" class="form-control form-control-sm advance_search" name="visit_type">
                            <option selected value="0">All</option>
                            @foreach ($all_visit_types as $item)
                                <option value="{{ $item->visit_type_id }}"
                                    {{ $item->visit_type_id == $visit_type ? 'selected' : '' }}>{{ $item->visit_type_name }}
                                </option>
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
                            <div class="col-md-1"><a href="{{ route('schedule_show') }}" name="refresh" id="refresh"
                                    class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Schedule</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_schedule')
            {{--            <h1 class="dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
        </div>
    </div>

    {{--    MODALS   --}}
    {{--    Reminder --}}
    @foreach ($datas as $schedule)
        <div class="modal fade reminder_no_{{ $schedule->schId }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sch_reminder') }}" method="post" id="sch_reminder">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Date</label>
                                        <input type="text" class="form-control sch_datetime" placeholder="Choose Date"
                                            name="reminder_date" autocomplete="off">
                                    </div>
                                </div>
                                @if (Auth::user()->role == 'Tele Caller')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Response</label>
                                            <select name="reminder_reason" id="" class="form-control">
                                                <option disabled hidden selected>Choose...</option>
                                                <option value="self_reminder">Self Reminder</option>
                                                <option value="kem_reminder">KEM Reminder</option>
                                                <option value="no_response">No Response</option>
                                                <option value="close_reminder">Close</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <textarea name="reminder_remarks" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="reminder_row_id" value="{{ $schedule->schId }}">
                                <input type="hidden" name="reminder_for_id" value="{{ $schedule->user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{--    Has Reminder --}}
    {{--    @foreach ($datas as $schedule) --}}
    {{--        <div class="modal fade has_reminder_{{$schedule->schId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    {{--            <div class="modal-dialog modal-dialog-centered" role="document"> --}}
    {{--                <div class="modal-content"> --}}
    {{--                    <div class="modal-header"> --}}
    {{--                        <h5 class="modal-title" id="exampleModalLabel">Update Reminder</h5> --}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
    {{--                            <span aria-hidden="true">&times;</span> --}}
    {{--                        </button> --}}
    {{--                    </div> --}}
    {{--                    <div class="modal-body"> --}}
    {{--                        <form action="{{route('re_schedule_reminder')}}" method="post"> --}}
    {{--                            @csrf --}}
    {{--                            <div class="row"> --}}
    {{--                                <div class="col-md-12"><b>Reminder Date: </b>{{date('d-M-Y H:i:s', strtotime($schedule->reminder_date))}}<br><br></div> --}}
    {{--                                <div class="col-md-6"> --}}
    {{--                                    <div class="form-group"> --}}
    {{--                                        <label for="">Choose Date</label> --}}
    {{--                                        <input type="text" class="form-control sch_datetime" value="{{date('Y-m-d H:i:s',strtotime($schedule->reminder_date))}}" name="update_sch_reminder_date" autocomplete="off"> --}}
    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                                @if (Auth::user()->role == 'Tele Caller') --}}
    {{--                                    <div class="col-md-6"> --}}
    {{--                                        <div class="form-group"> --}}
    {{--                                            <label for="">Response</label> --}}
    {{--                                            <select name="update_reason" id="" class="form-control"> --}}
    {{--                                                <option disabled hidden selected>Choose...</option> --}}
    {{--                                                <option value="self_reminder">Self Reminder</option> --}}
    {{--                                                <option value="kem_reminder">KEM Reminder</option> --}}
    {{--                                                <option value="no_response">No Response</option> --}}
    {{--                                                <option value="close_reminder">Close</option> --}}
    {{--                                            </select> --}}
    {{--                                        </div> --}}
    {{--                                    </div> --}}
    {{--                                    <input type="hidden" name="update_reminder_id" value="{{$schedule->reminder_id}}"> --}}
    {{--                                @endif --}}
    {{--                                <div class="col-md-12"> --}}
    {{--                                    <div class="form-group"> --}}
    {{--                                        <label for="">Remarks</label> --}}
    {{--                                        <textarea name="update_sch_reminder_remarks" class="form-control" cols="30" rows="5">{{$schedule->reminder_remarks}}</textarea> --}}
    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                                <input type="hidden" name="update_sch_id" value="{{$schedule->id}}"> --}}
    {{--                                <input type="hidden" name="update_reminder_for_id" value="{{$schedule->user_id}}"> --}}
    {{--                            </div> --}}
    {{--                            <input type="submit" class="btn btn-primary" value="Submit"> --}}
    {{--                        </form> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    @endforeach --}}
    {{--    Remarks --}}
    @foreach ($datas as $schedule)
        <div class="modal fade remarks_no_{{ $schedule->schId }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sch_remarks') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Remarks Date</label>
                                        <input type="text" class="form-control sch_datetime" placeholder="Choose Date"
                                            name="remarks_date" autocomplete="off">
                                    </div>
                                </div>
                                {{--                                <div class="col-md-6"> --}}
                                {{--                                    <div class="form-group"> --}}
                                {{--                                        <label for="">Choose Schedule Date</label> --}}
                                {{--                                        <input type="text" class="form-control date" placeholder="Choose Date" name="sch_date" autocomplete="off"> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Remarks Detail</label>
                                        <textarea name="remarks_detail" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="remarks_row_id" value="{{ $schedule->id }}">
                                <input type="hidden" name="remarks_for_id" value="{{ $schedule->user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            // minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('schedule_show') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $('#companies').select2();
            $('#created_by').select2();
            $('#visit_type').select2();
            $('#sch_reminder').validate({
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
        //     var visit_type = $('#visit_type option:selected').val();
        //     var created_by = $('#created_by').val();
        //     var from_date = $('#from_date').val();
        //     var to_date = $('#to_date').val();
        //     var search = $('#search').val();
        //     $.ajax({
        //         url: '/schedule_show',
        //         type: 'get',
        //         data: {
        //             companies: companies,
        //             visit_type: visit_type,
        //             created_by: created_by,
        //             from_date: from_date,
        //             to_date: to_date,
        //             search: search
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
        //             console.log(XMLHttpRequest.responseText);
        //         }
        //     })
        // })

        // $('.sch_datetime').datetimepicker({
        //     minDate: new Date(),
        //     format: 'dd-MM-yy hh:mm:ss'
        // });
        $('.sch_datetime').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('.dataTable').DataTable({ //datatable
            "scrollX": true,
            "paging": false,
            "searching": false,
            "info": false,
            "sScrollXInner": "100%",
        });
    </script>
@endsection
