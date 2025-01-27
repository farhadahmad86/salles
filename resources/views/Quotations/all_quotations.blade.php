@extends('layouts/app')
@section('styles')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            font-size: 3.5rem;
            background-color: black;
            color: white;
            border-radius: 16px;
            letter-spacing: 20px;
        }

        .float-left {
            float: left;
        }

        .text-center {
            text-align: center
        }

        .header,
        .content {
            width: 100%;
            display: block;
        }

        .c-logo {
            width: 15%;
        }

        .c-logo img {
            width: 100%;
            max-width: 70px;
            margin: 0;
            display: block;
        }

        .purposal {
            width: 65%;
        }

        .ref-date {
            width: 20%;
            padding-left: 100px;
        }

        .ref-date p {
            white-space: nowrap;
            margin-bottom: 0 !important;
        }

        .width-50 {
            width: 50%;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .border-dotted {
            border-bottom: 1px dotted #444;
        }


        legend {
            font-weight: 500;
            margin-bottom: -9px;
            font-size: 16px;
            background-color: black;
            color: white;
            border-radius: 12px;
            letter-spacing: 5px;
        }

        p {
            margin-bottom: 0rem;
        }

        /* table {
                                                                                                                                                                                                                                                                                                        font-family: arial, sans-serif;
                                                                                                                                                                                                                                                                                                        border-collapse: collapse;
                                                                                                                                                                                                                                                                                                        width: 100%;
                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                    td,
                                                                                                                                                                                                                                                                                                    th {
                                                                                                                                                                                                                                                                                                        border: 1px solid #dddddd;
                                                                                                                                                                                                                                                                                                        text-align: left;
                                                                                                                                                                                                                                                                                                        padding: 8px;
                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                    tr:nth-child(even) {
                                                                                                                                                                                                                                                                                                        background-color: #dddddd;
                                                                                                                                                                                                                                                                                                    } */

        .fieldset {
            border: 2px solid;
            min-height: 128px;
            font-size: 12px;
        }


        .fieldset p {
            margin-block: 0 !important;
        }

        .modal-body {
            /* margin: 3rem !important; */
            margin: 0rem 3rem !important;
        }

        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%
            }
        }

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
            <form class="prnt_lst_frm" action="{{ route('quotations') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Subject Id</label>
                        <select id="subject_id" class="form-control form-control-sm advance_search" name="subject_id">
                            <option selected value="0">All</option>
                            @foreach ($all_subject_id as $subjects)
                                <option value="{{ $subjects->unique_id }}"
                                    {{ $subjects->unique_id == $subject_id ? 'selected' : '' }}>
                                    {{ $subjects->unique_id }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <label for="">POC</label>
                        <select id="pocs" class="form-control form-control-sm advance_search" name="pocs">
                            <option selected value="0">All</option>
                            @foreach ($all_poc as $poc)
                                <option value="{{ $poc->com_poc_profile_id }}"
                                    {{ $poc->com_poc_profile_id == $pocs ? 'selected' : '' }}>
                                    {{ $poc->com_poc_profile_name }}</option>
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
                        <label for="">Expiry From Date</label>
                        <input type="text" name="expiry_from_date" value="{{ $expiry_from_date }}"
                            class="form-control date advance_search form-control-sm expiry_from_date" id=""
                            placeholder="Choose...">
                    </div>
                    <div class="col-md-2">
                        <label for="">Expiry To Date</label>
                        <input type="text" name="expiry_to_date" value="{{ $expiry_to_date }}"
                            class="form-control date advance_search form-control-sm expiry_to_date" id=""
                            placeholder="Choose...">
                    </div>
                    <div class="col-md-2">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                            value="{{ $from_date }}" id="from_date" placeholder="Choose...">
                    </div>
                    <div class="col-md-2">
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
                <div class="row mt-3">
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
                            <div class="col-md-1"><a href="{{ route('quotations') }}" name="refresh" id="refresh"
                                    class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Quotations</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_quotations')
            {{--            <h1 class="dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1> --}}
        </div>
    </div>

    {{--    MODAL --}}

    {{--    Remarks --}}
    <form action="{{ route('approval_quotations') }}" method="POST">
        @csrf

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-group" name="approval_remarks" id="approval_remarks">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    Reminder --}}
    @foreach ($datas as $info)
        <div class="modal fade reminder_no_{{ $info->invoice_id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('purposal_reminder') }}" method="post" id="purposal_reminder">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Reminder Date</label>
                                        <input type="text" class="form-control purposal_datetime"
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
                                <input type="hidden" name="reminder_row_id" value="{{ $info->invoice_id }}">
                                <input type="hidden" name="reminder_for_id" value="{{ $info->invoice_user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--    Has Reminder --}}
    {{--    @foreach ($invoiceInfo as $info) --}}
    {{--        <div class="modal fade has_reminder_{{$info->invoice_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    {{--            <div class="modal-dialog modal-dialog-centered" role="document"> --}}
    {{--                <div class="modal-content"> --}}
    {{--                    <div class="modal-header"> --}}
    {{--                        <h5 class="modal-title" id="exampleModalLabel">Update Reminder</h5> --}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
    {{--                            <span aria-hidden="true">&times;</span> --}}
    {{--                        </button> --}}
    {{--                    </div> --}}
    {{--                    <div class="modal-body"> --}}
    {{--                        <form action="{{route('re_purposal_reminder')}}" method="post"> --}}
    {{--                            @csrf --}}
    {{--                            <div class="row"> --}}
    {{--                                <div class="col-md-6"> --}}
    {{--                                    <div class="form-group"> --}}
    {{--                                        <label for="">Choose Date</label> --}}
    {{--                                        <input type="text" class="form-control purposal_datetime" placeholder="Choose Date" value="{{date('Y-m-d H:i:s',strtotime($info->reminder_date))}}" name="update_purposal_reminder_date"> --}}
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
    {{--                                        <textarea name="update_purposal_reminder_remarks" class="form-control" cols="30" rows="5">{{$info->reminder_remarks}}</textarea> --}}
    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                                <input type="hidden" name="update_purposal_id" value="{{$info->invoice_id}}"> --}}
    {{--                                <input type="hidden" name="update_reminder_for_id" value="{{$info->invoice_user_id}}"> --}}
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
        <div class="modal fade remarks_no_{{ $info->invoice_id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('purposal_remarks') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Remarks Date</label>
                                        <input type="text" class="form-control purposal_datetime"
                                            placeholder="Choose Date" name="remarks_date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Remarks Detail</label>
                                        <textarea name="remarks_detail" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="remarks_row_id" value="{{ $info->invoice_id }}">
                                <input type="hidden" name="remarks_for_id" value="{{ $info->invoice_user_id }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--    Modal View Qoutatons --}}

    @foreach ($datas as $info)
        <div class="modal fade" id="invoice_modal_{{ $info->invoice_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 90%" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Quotations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            {{--                            <div class="col-md-3"> --}}
                            {{--                                <label for="">Category</label> --}}
                            {{--                                <select id="modal_category" class="form-control form-control-sm modal_advance_search" name="category"> --}}
                            {{--                                    <option selected value="0">All</option> --}}

                            {{--                                </select> --}}
                            {{--                            </div> --}}
                            {{--                            <input type="hidden" value="{{$info->invoice_id}}" class="invoice_id"> --}}
                            {{--                            <div class="col-md-3"> --}}
                            {{--                                <label for="">Product</label> --}}
                            {{--                                <select id="modal_product" class="form-control form-control-sm modal_advance_search" name="product"> --}}
                            {{--                                    <option selected value="0">All</option> --}}
                            {{--                                </select> --}}
                            {{--                            </div> --}}
                            {{--                            <div class="col-md-2"> --}}
                            {{--                                <label for="">From Date</label> --}}
                            {{--                                <input type="text" name="from_date" class="form-control date modal_advance_search form-control-sm modal_from_date" id="" placeholder="Choose..."> --}}
                            {{--                            </div> --}}
                            {{--                            <div class="col-md-2"> --}}
                            {{--                                <label for="">To Date</label> --}}
                            {{--                                <input type="text" name="to_date" class="form-control date modal_advance_search form-control-sm modal_to_date" id="" placeholder="Choose..."> --}}
                            {{--                            </div> --}}
                            <div class="col-md-12">
                                <div class="btn-group btn-sm float-right">
                                    <button type="button" class="btn btn-primary grp_btn"
                                        onclick="print_content('content_pdf')">Print</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle grp_btn"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column"
                                        x-placement="bottom-end">
                                        <button type="button" class="dropdown-item" id=""
                                            onclick="print_content('content_download_pdf')">
                                            <i class="fa fa-print"></i> Download PDF
                                        </button>
                                        {{-- <button type="button" class="dropdown-item"
                                            onclick="prnt_cus('download_excel')">
                                            <i class="fa fa-file-excel-o"></i> Excel Sheet
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body has_invoices">
                        <header class="header">
                            <div class="row">
                                <div class="c-logo float-left">

                                    <img src="{{ asset('storage/img/' . $business_profile->business_profile_logo) }}">
                                </div>
                                <div class="purposal float-left text-center">
                                    <h1>Proposal</h1>
                                </div>
                                <div class="ref-date float-left">
                                    <p><b>Subject:</b> {{ $info->subject }}</p>
                                    <p><b>Version:</b> {{ $info->version }}</p>
                                    <p><b>Date:</b> <span class="border-dotted">{{ $info->inv_date }}</span>
                                    </p>
                                </div>
                            </div>
                        </header>
                        <section class="content">
                            <div class="row">
                                <div class="width-50 float-left">
                                    <fieldset class="p-2 fieldset">
                                        <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                                        <p><b>Company Name</b>
                                            <i id="">{{ $business_profile->business_profile_name }}</i>
                                        </p>
                                        <p><b>Address</b>
                                            <i id="">{{ $info->address }}</i>
                                        </p>
                                        <p><b>Contact #</b>
                                            <i id="">{{ $info->mob }}</i>
                                        </p>
                                        <p><b>Prepared By</b>
                                            <i id="">{{ $info->name }}</i>
                                        </p>
                                    </fieldset>
                                </div>
                                <div class="width-50 float-left">
                                    <fieldset class="p-2 fieldset">
                                        <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                                        <p><b>Company Name</b>
                                            <i id="cient_name">{{ $info->company_name }}</i>
                                        </p>
                                        <p><b>P.O.C</b>
                                            <i id="poc">{{ $info->poc_name }}</i>
                                        </p>
                                        <p><b>Contact #</b>
                                            <i id="contact">{{ $info->comp_mobile_no }}</i>
                                        </p>
                                        <p><b>Email</b>
                                            <i id="email">{{ $info->comp_email }}</i>
                                        </p>
                                        <p><b>Subject Id</b>
                                            <i id="subject_id">{{ $info->unique_id }}</i>
                                        </p>
                                    </fieldset>
                                </div>
                            </div>
                            <table class="table" style="border-collapse:collapse; border:1px solid #dee2e6;">
                                <thead style="border-color:#dee2e6">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 70%">Item Discription</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="invoice_view_table_row" style="border-color:#dee2e6">
                                </tbody>
                            </table>
                            <div class="row">
                                <h3>Terms &amp; Conditions</h3>
                                <div class="set_tandc"></div>
                            </div>
                        </section>
                        <h1 class="modal_dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1>
                    </div>
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
        $('document').ready(function() {
            $('#subject_id').select2();
            $('#companies').select2();
            $('#pocs').select2();
            $('#created_by').select2();

            $('#purposal_reminder').validate({
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
        var base = '{{ route('quotations') }}',
            url;
        @include('print.print_script_sh')

        // $('.refresh').click(function () {
        //     $('#column_name option:contains("--choose--")').prop('selected', true);
        //     $('#select_by option:contains("--choose--")').prop('selected', true);
        // });

        // function invoice_view_modal(){
        $('.invoice_view_modal').click(function() {
            var invoice_id = $(this).data('target');
            invoice_id = invoice_id.substring(15);
            $.ajax({
                url: '{{ route('view_qoutations') }}',
                method: 'get',
                datatype: 'json',
                data: {
                    'invoice_id': invoice_id
                },
                success: function(response) {
                    console.log(response);
                    if (response.count_row != 0) {
                        $('.set_tandc').html('');
                        $('.dummy_data').hide();
                        $('#modal_category').html('');
                        $('#modal_product').html('');
                        $('.has_invoices').show();
                        $('.invoice_view_table_row').html('');
                        $('#modal_category').html(response.my_category);
                        $('#modal_product').html(response.my_product);
                        $('.invoice_view_table_row').html(response.table_row);
                        $('.invoice_view_table_row').append(response.grand_total);
                        $('.date, .show_date').html(response.invoice_date);
                        // $('.comp, .show_comp').html(response.company_name).css('text-transform',
                        //     'capitalize');
                        // $('#subject').html('');
                        // // $('#subject').append(response.get_info.subject);
                        // $('#version').html('');
                        // $('#version').append(response.get_info.version);
                        // $('#datee').html('');
                        // $('#datee').append(response.get_info.date);
                        // $('#cient_name').html('');
                        // $('#cient_name').append(response.get_info.company_name);
                        // $('#contact').html('');
                        // $('#contact').append(response.get_info.comp_mobile_no);
                        // $('#email').html('');
                        // $('#email').append(response.get_info.comp_email);
                        // $('#subject_id').html('');
                        // $('#subject_id').append(response.get_info.unique_id);
                        // $('#poc').html('');
                        // $('#poc').append(response.get_info.poc_name);
                        for (var i = 0; i < response.getting_terms.length; i++) {
                            $('.set_tandc').append(`
                                <h5 class="tandc_title">${response.getting_terms[i].tandc_title}
                                </h5>\n
                                <div class="tandc_description">${response.getting_terms[i].tandc_description}</div>`);
                        }
                    } else {
                        $('.has_invoices').hide();
                        $('.dummy_data').show();
                    }
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        });
        // }
        // invoice_view_modal();

        // $('.modal_advance_search').change(function () {
        //     var category = $('#modal_category option:selected').val();
        //     var product = $('#modal_product option:selected').val();
        //     var invoice_id = $('.invoice_id').val();
        //     var from_date = $('.modal_from_date').val();
        //     var to_date = $('.modal_to_date').val();
        //     // alert('category: '+category + ' product: '+product + ' invoice: '+invoice_id + ' from_date: '+from_date + ' to_date: '+to_date);
        //     $.ajax({
        //         url: '/invoice_modal_search',
        //         type: 'get',
        //         data: {
        //             category: category,
        //             product: product,
        //             invoice_id: invoice_id,
        //             from_date: from_date,
        //             to_date: to_date,
        //         },
        //         dataType: 'json',
        //         success: function(response){
        //             console.log(response);
        //             if (response.count_row != 0){
        //                 $('.modal_dummy_data').hide();
        //                 $('.has_invoices').show();
        //                 $('.invoice_view_table_row').html('');
        //                 $('.invoice_view_table_row').html(response.table_row);
        //                 $('.invoice_view_table_row').append(response.grand_total);
        //                 $('.date, .show_date').html(response.invoice_date);
        //                 $('.comp, .show_comp').html(response.company_name).css('text-transform', 'capitalize');
        //             } else{
        //                 $('.has_invoices').hide();
        //                 $('.modal_dummy_data').show();
        //             }
        //         },
        //         error: function (XMLHttpRequest) {
        //             console.log(XMLHttpRequest.responseJSON.message);
        //         }
        //     })
        // })

        // $('.advance_search').change(function () {
        //     var companies = $('#companies option:selected').val();
        //     var created_by = $('#created_by option:selected').val();
        //     var from_date = $('.from_date').val();
        //     var to_date = $('.to_date').val();
        //     // alert('companies: '+ companies+ ' created by: '+created_by+ ' from_date: '+from_date + ' to_date: '+to_date);
        //     $.ajax({
        //         url: '/invoice_advance_search',
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

        $('.purposal_datetime').datepicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY HH:mm:ss'
        });
    </script>
@endsection
