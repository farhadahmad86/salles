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
            <form class="prnt_lst_frm" action="{{ route('order') }}">
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
                            <div class="col-md-1"><a href="{{ route('order') }}" name="refresh" id="refresh"
                                    class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">Order</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_order')
            {{-- <h1 class="dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
        </div>
    </div>

    {{--    MODAL   --}}

    {{--    Reminder --}}
    @foreach ($datas as $info)
        <div class="modal fade reminder_no_{{ $info->order_id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('order_reminder') }}" method="post" id="order_reminder">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Reminder Date</label>
                                        <input type="text" class="form-control order_datetime"
                                            placeholder="Choose Date" name="reminder_date">
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
                                        <label for="">Reminder Remarks</label>
                                        <textarea name="reminder_remarks" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="reminder_row_id" value="{{ $info->order_id }}">
                                <input type="hidden" name="reminder_for_id" value="{{ $info->order_user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--    Has Reminder --}}

    {{--    @foreach (datas as $info) --}}
    {{--        <div class="modal fade has_reminder_{{$info->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    {{--            <div class="modal-dialog modal-dialog-centered" role="document"> --}}
    {{--                <div class="modal-content"> --}}
    {{--                    <div class="modal-header"> --}}
    {{--                        <h5 class="modal-title" id="exampleModalLabel">Update Reminder</h5> --}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
    {{--                            <span aria-hidden="true">&times;</span> --}}
    {{--                        </button> --}}
    {{--                    </div> --}}
    {{--                    <div class="modal-body"> --}}
    {{--                        <form action="{{route('re_order_reminder')}}" method="post"> --}}
    {{--                            @csrf --}}
    {{--                            <div class="row"> --}}
    {{--                                <div class="col-md-6"> --}}
    {{--                                    <div class="form-group"> --}}
    {{--                                        <label for="">Choose Date</label> --}}
    {{--                                        <input type="text" class="form-control order_datetime" placeholder="Choose Date" value="{{date('Y-m-d H:i:s',strtotime($info->reminder_date))}}" name="update_order_reminder_date"> --}}
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
    {{--                                    <input type="hidden" name="update_reminder_id" value="{{$info->reminder_id}}"> --}}
    {{--                                @endif --}}
    {{--                                <div class="col-md-12"> --}}
    {{--                                    <div class="form-group"> --}}
    {{--                                        <label for="">Remarks</label> --}}
    {{--                                        <textarea name="update_order_reminder_remarks" class="form-control" cols="30" rows="5">{{$info->reminder_remarks}}</textarea> --}}
    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                                <input type="hidden" name="update_order_id" value="{{$info->order_id}}"> --}}
    {{--                                <input type="hidden" name="update_reminder_for_id" value="{{$info->order_user_id}}"> --}}
    {{--                            </div> --}}
    {{--                            <input type="submit" class="btn btn-primary" value="Submit"> --}}
    {{--                        </form> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    @endforeach --}}

    {{--    Remarks --}}
    @foreach ($datas as $info)
        <div class="modal fade remarks_no_{{ $info->order_id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('order_remarks') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Remarks Date</label>
                                        <input type="text" class="form-control order_datetime"
                                            placeholder="Choose Date" name="remarks_date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Remarks Detail</label>
                                        <textarea name="remarks_detail" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="remarks_row_id" value="{{ $info->order_id }}">
                                <input type="hidden" name="remarks_for_id" value="{{ $info->order_user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--    Showing Order Invoices --}}
    @foreach ($datas as $info)
        <div class="modal fade order_modal_{{ $info->order_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Invoices</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{--                <div class="row mt-3 mb-2"> --}}
                    {{--                    <div class="col-md-1"></div> --}}
                    {{--                    <div class="col-md-3"> --}}
                    {{--                        <label for="">Category</label> --}}
                    {{--                        <select id="modal_category" class="form-control form-control-sm modal_advance_search"> --}}
                    {{--                            <option selected value="0">All</option> --}}

                    {{--                        </select> --}}
                    {{--                    </div> --}}
                    {{--                    <input type="hidden" value="{{$info->order_id}}" id="order_id"> --}}
                    {{--                    <div class="col-md-3"> --}}
                    {{--                        <label for="">Product</label> --}}
                    {{--                        <select id="modal_product" class="form-control form-control-sm modal_advance_search"> --}}
                    {{--                            <option selected value="0">All</option> --}}
                    {{--                        </select> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-2"> --}}
                    {{--                        <label for="">From Date</label> --}}
                    {{--                        <input type="text" name="from_date" class="form-control date modal_advance_search form-control-sm modal_from_date" id="" placeholder="Choose..."> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-2"> --}}
                    {{--                        <label for="">To Date</label> --}}
                    {{--                        <input type="text" name="to_date" class="form-control date modal_advance_search form-control-sm modal_to_date" id="" placeholder="Choose..."> --}}
                    {{--                    </div> --}}
                    {{--                </div> --}}
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-8" id="add_margin">
                                <div><b>Company: </b><span class="comp"></span></div>
                                <div><b>Date: </b><span class="datee"></span></div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-sm btn-primary float-right" id="prnt"
                                    onclick="printContent()">Print</button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Category</th>
                                    <th>Quantity</th>
                                    <th>Sale</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="order_view_table_row">
                            </tbody>
                        </table>
                        <h3 style="text-decoration: underline" class="tandcTitle">Terms And Conditions</h3>
                        <div class="set_tandc"></div>

                    </div>
                    {{-- <h1 class="modal_dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        var base = '{{ route('order') }}',
            url;
        @include('print.print_script_sh')
        $('document').ready(function() {
            $('#companies').select2();
            $('#created_by').select2();
            $('#order_reminder').validate({
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

        $('.order_view_modal').click(function() {
            var order_id = $(this).data('target');
            order_id = order_id.substring(13);
            $.ajax({
                url: '{{ route('view_order')}}',
                method: 'get',
                datatype: 'json',
                data: {
                    'order_id': order_id
                },
                success: function(response) {
                    console.log(response);
                    if (response.count_row != 0) {
                        $('.set_tandc').html('');
                        $('#print').show();
                        $('.tandc_title').html('');
                        $('.tandc_description').html('');
                        $('#modal_category').html('');
                        $('#modal_product').html('');
                        $('#modal_category').html(response.my_category);
                        $('#modal_product').html(response.my_product);
                        $('.order_view_table_row').html('');
                        $('.order_view_table_row').html(response.table_row);
                        $('.order_view_table_row').append(response.grand_total);
                        $('.datee, .show_date').html(response.order_date);
                        $('.comp, .show_comp').html(response.company_name).css('text-transform',
                            'capitalize');
                        for (var i = 0; i < response.getting_terms.length; i++) {
                            $('.set_tandc').append(
                                '<h5 class="tandc_title">' + response.getting_terms[i].tandc_title +
                                '</h5>\n' +
                                '<div class="tandc_description">' + response.getting_terms[i]
                                .tandc_description + '</div>'
                            );
                        }
                    } else {
                        $('#print').hide();
                        $('.modal_dummy_data').show();
                    }
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        });

        // $('.advance_search').change(function () {
        //     var companies = $('#companies option:selected').val();
        //     var created_by = $('#created_by option:selected').val();
        //     var from_date = $('.from_date').val();
        //     var to_date = $('.to_date').val();
        //     // alert('companies: '+ companies+ ' created by: '+created_by+ ' from_date: '+from_date + ' to_date: '+to_date);
        //     $.ajax({
        //         url: '/order_advance_search',
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

        // $('.modal_advance_search').change(function () {
        //     var category = $('#modal_category option:selected').val();
        //     var product = $('#modal_product option:selected').val();
        //     var order_id = $('#order_id').val();
        //     var from_date = $('.modal_from_date').val();
        //     var to_date = $('.modal_to_date').val();
        //     // alert('category: '+category + ' product: '+ product + ' order: '+ order_id + ' from_date: '+ from_date + ' to_date: '+ to_date);
        //     $.ajax({
        //         url: '/order_modal_search',
        //         type: 'get',
        //         data: {
        //             category: category,
        //             product: product,
        //             order_id: order_id,
        //             from_date: from_date,
        //             to_date: to_date,
        //         },
        //         dataType: 'json',
        //         success: function(response){
        //             console.log(response);
        //             if (response.count_row != 0){
        //                 $('.modal_dummy_data').hide();
        //                 $('#print').show();
        //                 $('.order_view_table_row').html('');
        //                 $('.order_view_table_row').html(response.table_row);
        //                 $('.order_view_table_row').append(response.grand_total);
        //                 $('.date, .show_date').html(response.invoice_date);
        //                 $('.comp, .show_comp').html(response.company_name).css('text-transform', 'capitalize');
        //             } else{
        //                 $('#print').hide();
        //                 $('.modal_dummy_data').show();
        //             }
        //         },
        //         error: function (XMLHttpRequest) {
        //             console.log(XMLHttpRequest.responseJSON.message);
        //         }
        //     })
        // })

        $('.order_datetime').datepicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY HH:mm:ss'
        });
    </script>
@endsection
