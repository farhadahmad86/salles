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
            <form class="prnt_lst_frm" action="{{ route('orderRemarks') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Companies</label>
                        <select id="companies" class="form-control form-control-sm advance_search" name="companies">
                            <option selected value="0">All</option>
                            @foreach ($order_remarks as $item)
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
                    <div class="col-md-1">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" value="{{ $from_date }}"
                            class="form-control date advance_search form-control-sm from_date" id=""
                            placeholder="Choose...">
                    </div>
                    <div class="col-md-1">
                        <label for="">To Date</label>
                        <input type="text" name="to_date" value="{{ $to_date }}"
                            class="form-control date advance_search form-control-sm to_date" id=""
                            placeholder="Choose...">
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
                            <div class="col-md-1">
                                <a href="{{ route('orderRemarks') }}" name="refresh" id="refresh"
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
    <div class="card mt-5">
        <div class="card-header">Order Reminder</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_order_remarks')
            {{--            <h1 class="dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
        </div>
    </div>
    {{--    MODAL --}}
    {{--        @foreach ($sch as $schedule) --}}
    {{--            <div class="modal fade modal_no_{{$schedule->schId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    {{--                <div class="modal-dialog modal-dialog-centered" role="document"> --}}
    {{--                    <div class="modal-content"> --}}
    {{--                        <div class="modal-header"> --}}
    {{--                            <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5> --}}
    {{--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
    {{--                                <span aria-hidden="true">&times;</span> --}}
    {{--                            </button> --}}
    {{--                        </div> --}}
    {{--                        <div class="modal-body"> --}}
    {{--                            <form action="{{route('sch_reminder')}}" method="post"> --}}
    {{--                                @csrf --}}
    {{--                                <div class="row"> --}}
    {{--                                    <div class="col-md-6"> --}}
    {{--                                        <div class="form-group"> --}}
    {{--                                            <label for="">Choose Reminder Date</label> --}}
    {{--                                            <input type="text" class="form-control date" placeholder="Choose Date" name="sch_reminder" autocomplete="off"> --}}
    {{--                                        </div> --}}
    {{--                                    </div> --}}
    {{--                                    <div class="col-md-12"> --}}
    {{--                                        <div class="form-group"> --}}
    {{--                                            <label for="">Reminder Remarks</label> --}}
    {{--                                            <textarea name="sch_reminder_remarks" class="form-control" cols="30" rows="5"></textarea> --}}
    {{--                                        </div> --}}
    {{--                                    </div> --}}
    {{--                                    <input type="hidden" name="sch_id" value="{{$schedule->id}}"> --}}
    {{--                                </div> --}}
    {{--                                <input type="submit" class="btn btn-primary" value="Submit" id="submit"> --}}
    {{--                            </form> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        @endforeach --}}
@endsection

@section('javascript')
    <script>
        // $('.sch_datetime').datetimepicker({
        //     minDate: new Date(),
        // });

        var base = '{{ route('orderRemarks') }}',
            url;
        @include('print.print_script_sh')

        $('.date').datepicker({
            // minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });

        // $('.advance_search').change(function () {
        //     var companies = $('#companies option:selected').val();
        //     var created_by = $('#created_by option:selected').val();
        //     var from_date = $('.from_date').val();
        //     var to_date = $('.to_date').val();
        //     $.ajax({
        //         url: '/remarks_order_advance_search',
        //         type: 'get',
        //         data: {
        //             companies: companies,
        //             created_by: created_by,
        //             from_date: from_date,
        //             to_date: to_date,
        //         },
        //         dataType: 'json',
        //         success: function(response){
        //             console.log(response);
        //             if (response.count_row != 0){
        //                 $('.dummy_data').hide();
        //                 $('.table_row').show();
        //                 $('.table_row').html(response.table_row);
        //             } else{
        //                 $('.table_row').hide();
        //                 $('.dummy_data').show();
        //             }
        //         },
        //         error: function (XMLHttpRequest) {
        //             console.log(XMLHttpRequest.responseJSON.message);
        //         }
        //     })
        // })

        $('.dataTable').DataTable({ //datatable
            "scrollX": true,
            "sScrollXInner": "100%",
        });

        // $('#submit').click(function () {
        //     notification();
        // })
        $('document').ready(function() {
            $('#companies').select2();
            $('#created_by').select2();
        });
    </script>
@endsection
