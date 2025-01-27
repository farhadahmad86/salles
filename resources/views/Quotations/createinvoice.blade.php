{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .input-error {
            outline: 1px solid red;
        }
    </style>
</head>

<body> --}}
{{-- <h2>jQuery input filter showcase</h2>
    <p>Supports Copy+Paste, Drag+Drop, keyboard shortcuts, context menu operations, non-typeable keys, the caret
        position,
        different keyboard layouts, and <a href="https://caniuse.com/#feat=input-event" target="_blank">all browsers since
            IE
            9</a>.</p>
    <p>There is also a <a href="https://jsfiddle.net/emkey08/zgvtjc51" target="_blank">pure JavaScript version</a> of this
        (without jQuery).</p> --}}
{{-- <table> --}}
{{-- <tr>
            <td>Integer</td>
            <td><input id="intTextBox"></td>
        </tr>
        <tr>
            <td>Integer &gt;= 0</td>
            <td><input id="uintTextBox"></td>
        </tr> --}}
{{-- <tr>
            <td>sale &gt;= 0 and &lt;= 500</td>
            <td><input id="intLimitTextBox"></td>
        </tr>
        <tr>
            <td>btm &gt;= 0 and &lt;= 500</td>
            <td><input id="botmprice" value="400"></td>
        </tr> --}}
{{-- <tr> --}}
{{-- <td>sale &gt;= 0 and &lt;= 500</td>
            <td><input id="sale"></td>
        </tr>

        <tr>
            <td>butom &gt;= 0 and &lt;= 500</td>
            <td><input id="botmprice" value="400"></td>
            <span style="color:red" id="error"></span>
        </tr> --}}



{{-- <tr>
            <td>Float (use . or , as decimal separator)</td>
            <td><input id="floatTextBox"></td>
        </tr>
        <tr>
            <td>Currency (at most two decimal places)</td>
            <td><input id="currencyTextBox"></td>
        </tr>
        <tr>
            <td>A-Z only</td>
            <td><input id="latinTextBox"></td>
        </tr>
        <tr>
            <td>Hexadecimal</td>
            <td><input id="hexTextBox"></td>
        </tr> --}}
{{-- </table> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
{{-- <script>
        $('#sale').keyup(function(e) {
            let sale = $(this).val();
            let botmprice = $('#botmprice').val();
            if (sale <= botmprice) {
                $(this).val(botmprice);
                $('#error').html('fjkdsh jkdshfsd fjsdjhf ');

            } else {
                $('#error').html(' ');
            }
        }); --}}
{{-- // Restricts input
// for each element in the set of matched elements to the given inputFilter. --}}
{{-- // (function($) {
// $.fn.inputFilter = function(callback, errMsg) {
// return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout",
// function(e) {
// if (callback(this.value)) {
// // Accepted value
// if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 1) {
// $(this).removeClass("input-error");
// this.setCustomValidity("");
// }
// this.oldValue = this.value;
// this.oldSelectionStart = this.selectionStart;
// this.oldSelectionEnd = this.selectionEnd;
// } else if (this.hasOwnProperty("oldValue")) {
// // Rejected value - restore the previous one
// $(this).addClass("input-error");
// this.setCustomValidity(errMsg);
// this.reportValidity();
// this.value = this.oldValue;
// this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
// } else {
// // Rejected value - nothing to restore
// this.value = "";
// }
// });
// };
// }(jQuery));
// var btmprice = $('#botmprice').val();
// $("#intLimitTextBox").inputFilter(function(value) {
// return /^\d*$/.test(value) && (value === '' || value >= btmprice);
// }, "Must be between 1 and " + btmprice);
// $("#botmprice").inputFilter(function(value) {
// return /^-?\d*$/.test(value);
// }, "Must be an integer");
// $('#intLimitTextBox').keyup(function(e) {
// if ($(this).val().match(/^0/)) {
// $(this).val('');
// return false;
// }
// });

// Install input filters.
// $("#intTextBox").inputFilter(function(value) {
// return /^-?\d*$/.test(value);
// }, "Must be an integer");
// $("#uintTextBox").inputFilter(function(value) {
// return /^\d*$/.test(value);
// }, "Must be an unsigned integer");
// $("#floatTextBox").inputFilter(function(value) {
// return /^-?\d*[.,]?\d*$/.test(value);
// }, "Must be a floating (real) number");
// $("#currencyTextBox").inputFilter(function(value) {
// return /^-?\d*[.,]?\d{0,2}$/.test(value);
// }, "Must be a currency value"); --}}
{{-- // $("#latinTextBox").inputFilter(function(value) { --}}
{{-- // return /^[a-z]*$/i.test(value); --}}
{{-- // }, "Must use alphabetic latin characters"); --}}
{{-- // $("#hexTextBox").inputFilter(function(value) { --}}
{{-- // return /^[0-9a-f]*$/i.test(value); --}}
{{-- // }, "Must use hexadecimal characters"); --}}
{{-- // </script> --}}

{{-- // </body> --}}

//

{{-- </html> --}}
{{-- @extends('layouts/app')
@section('styles')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Add Invoice</div>
        <div class="card-body">
            <form action="{{ route('storeInvoice') }}" method="post" id="invoice_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" id="date" name="date" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose Date...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company</label>
                            <select class="form-control form-control-sm " name="comp_id" id="comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($comp as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product</label>
                            <select class="form-control form-control-sm" name="prod_id" onchange="showDetail(this)"
                                id="prod_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($prod as $product)
                                    <option value="{{ $product->id }}" data-product="{{ $product->product_price_sale }}"
                                        data-category="{{ $product->cat_id }}"
                                        data-bottomPrice="{{ $product->product_price_purchase }}"
                                        data-unit="{{ $product->unit_name }}">
                                        {{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" style="display: none">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control form-control-sm select2" id="cat_id" name="category" disabled>
                                <option disabled selected hidden>Choose Product</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->cat_id }}">{{ $cat->cat_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Bottom RS/-</label>
                            <input type="text" name="btm_rs" id="btm_rs" class="form-control form-control-sm"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Total RS/-</label>
                            <input type="number" name="amount" id="amount" class="form-control form-control-sm"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="text" onkeypress="justNo(event)" name="qty" value="" id="qty"
                                class="form-control form-control-sm" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sale</label>
                            <input type="text" onkeypress="justNo(event)" name="sale" id="sale" value=""
                                class="form-control form-control-sm" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-control form-control-sm">
                                <option value="OTC">OTC</option>
                                <option value="MRC">MRC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-primary btn-sm btn-top-m" id="adding" value="Add">
                    </div>
                    <input type="hidden" name="grand_total" class="form-control form-control-sm" id="gr_total"
                        placeholder="Grand Total"> --}}
{{--                    <div class="col-md-12 text-center"> --}}
{{--                        <div class="form-group"> --}}
{{--                            <input type="button" class="btn btn-primary" id="adding" style="margin-top: 32px" value="Add"> --}}
{{--                        </div> --}}
{{--                    </div> --}}
{{-- </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">Invoices
            {{--            <button class="btn btn-primary btn-sm float-right" id="prnt" style="display: none" onclick="printContent()">Print</button> --}}
{{-- </div>
        <div id="print"> --}}
{{--            <div id="print_info" style="display:none;"> --}}
{{--                <br> --}}
{{--                <h1 style="text-align: center;">{{$business_profile->business_profile_name}}</h1> --}}
{{--                <h4 style="text-align: center;">{{$business_profile->business_profile_email}}</h4> --}}
{{--                <h4 style="text-align: center;">{{$business_profile->business_profile_mobile_no}}</h4> --}}
{{--                <br> --}}
{{--                <h6><b>Company: </b><span id="show_comp"></span></h6> --}}
{{--                <h6><b>Date: </b><span id="show_date"></span></h6> --}}
{{--                <br> --}}
{{--            </div> --}}
{{-- <div class="card-body">
                <h3 style="text-align: center" id="noData">No Data Found</h3>
                <table class="table table-hover" id="invoice-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Sale</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Payment Type</th>
                            <th class="rmv1">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">

                    </tbody>
                </table>
                <p class="text-right" id="totalDis">Grand Total: <b id="g_total"></b></p>
                <button class="btn btn-primary float-right rmv3" id="invoiceSubmit" form="invoice_form">Submit</button>
            </div>
        </div>
    </div> --}}
{{-- @endsection --}}


{{-- @section('javascript')
    <script>
        $('#date').datepicker({
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });
        $('.select2').select2();
        var count = 0;
        $(document).ready(function() {
            $('#adding').click(function() {
                var company = $('#comp_id option:selected').text();
                var product_id = $('#prod_id option:selected').val();
                var product = $('#prod_id option:selected').text();
                var payment_type = $('#payment_type option:selected').val();
                var sale = $('#sale').val();
                var quantity = $('#qty').val();
                var amount = $('#amount').val();
                var date = $('#date').val();
                var cat_id = $('#cat_id').val();
                $('#show_comp').text(company);
                $('#show_date').text(date);
                if (date == '') {
                    $('#date').focus();
                    return;
                }
                if ($('#comp_id')[0].selectedIndex <= 0) {
                    $('#comp_id').focus();
                    return;
                }
                if ($('#prod_id')[0].selectedIndex <= 0) {
                    $('#prod_id').focus();
                    return;
                }
                if (quantity == '') {
                    $('#qty').focus();
                    return;
                }
                if (sale == '') {
                    $('#sale').focus();
                    return;
                }
                disable_pro(product_id);
                $('#invoice_form').append("<input type='text' class='" + count + " product" + count +
                    "' id='prod_id' value='" + product_id + "' name='prod_id[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + " payment_type" + count +
                    "' id='payment_type' value='" + payment_type + "' " +
                    "name='payment_type[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + "' value='" + date +
                    "' name='sale_invoice_date[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + "' id='sale' value='" +
                    sale + "' name='sale[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + "' id='qty' value='" +
                    quantity + "' name='qty[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + "' id='amount' value='" +
                    amount + "' name='amount[]'>");
                $('#invoice_form').append("<input type='text' class='" + count + "' id='cat_id' value='" +
                    cat_id + "' name='category[]'>");
                $('#table-body').append("<tr><td>" + product + "</td><td>" + sale + "</td><td>" + quantity +
                    "</td><td>" + amount + "</td><td>" + payment_type + "</td><td><button " +
                    "type='submit' " + "onclick='remove(this, " + count +
                    ")' class='btn btn-danger btn-sm rmv2'>Remove</button></td></tr>");
                count++;
                $('#prod_id').val('');
                $('#sale').val('');
                $('#qty').val('');
                $('#amount').val('');
                $('#btm_rs').val('');
                $('#payment_type').val('OTC');
                $("#cat_id").select2("destroy");
                $("#cat_id > option").each(function() {
                    $('#cat_id option:selected').prop('selected', false);
                });
                $('#cat_id').select2();
                $('#comp_id').css('pointer-events', 'none');
                $('#date').css('pointer-events', 'none');
                $('#prnt').css('display', 'inline-block');
                grand_total();
                var tableRow = $('#table-body').children().length;
                if (tableRow == 1) {
                    $('#noData').hide();
                    $('#invoice-table,#invoiceSubmit,#totalDis').show();
                }
            });
        });

        function disable_pro(value) {
            $('#prod_id option[value=' + value + ']').attr('disabled', 'disabled');
        }

        function showDetail(e) {
            var salePrice = $('option:selected', e).attr('data-product');
            var bottom_price = $('option:selected', e).attr('data-bottomPrice');
            var unit = $('option:selected', e).attr('data-unit');
            $('#sale').val(salePrice);
            $('#btm_rs').val(bottom_price);
            $('#unit').val(unit);
            var quantity = $('#qty').val();
            var sale = $('#sale').val();
            var multi = quantity * sale;
            $('#amount').val(multi);
            var category = $('option:selected', e).attr('data-category');
            var nameArr = category.split(',');
            $("#cat_id").select2("destroy");
            // $("#cat_id > option").each(function () {
            //     $('#cat_id option:selected').prop('selected', false);
            // });
            $("#cat_id > option").each(function() {
                $.each(nameArr, function(i, val) {
                    $('#cat_id option[value="' + val + '"]').prop('selected', true);
                });
            });
            $("#cat_id").select2();
        }
        $(document).ready(function() {

            $('#qty').keyup(function() {
                var quantity = $('#qty').val();
                var sale = $('#sale').val();
                var multi = quantity * sale;
                $('#amount').val(multi);
            });
            $('#sale').keyup(function() {
                var quantity = $('#qty').val();
                var sale = $('#sale').val();
                var multi = quantity * sale;
                $('#amount').val(multi);
            });
        });

        //deleting selected row index
        function remove(r, row_del) {
            var getting = $('.product' + row_del).val();
            $("#prod_id option").each(function() {
                if ($(this).val() == getting) { // EDITED THIS LINE
                    $('#prod_id option[value=' + getting + ']').attr('disabled', false);
                }
            });
            $('.' + row_del).remove();
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("invoice-table").deleteRow(i);
            count--;
            grand_total();
            var tableRow = $('#table-body').children().length;
            if (tableRow == 0) {
                $('#noData').show();
                $('#invoice-table,#invoiceSubmit,#totalDis').hide();
                $('#prnt').css('display', 'none');
            }
        }
        //if table index is 0, it will hide table, submit and grand total
        var tableRow = $('#table-body').children().length;
        if (tableRow == 0) {
            $('#invoice-table,#invoiceSubmit,#totalDis').hide();
        }


        //For Print
        // function printContent()
        // {
        //     $('.rmv1').hide();
        //     $('.rmv2').hide();
        //     $('.rmv3').hide();
        //     $('#print_info').show();
        //     var divToPrint = document.getElementById('print');
        //     var htmlToPrint = '' +
        //         '<style type="text/css">' +
        //         'table, th, td'+
        //         '{'+
        //         'border-collapse:collapse;'+
        //         'border: 1px solid black;'+
        //         'width:100%;'+
        //         'padding;0.5em;' +
        //         '}'+
        //         '</style>';
        //     htmlToPrint += divToPrint.outerHTML;
        //     newWin = window.open("");
        //     newWin.document.write(htmlToPrint);
        //     newWin.print();
        //     newWin.close();
        //     $('.rmv1').show();
        //     $('.rmv2').show();
        //     $('.rmv3').show();
        //     $('#print_info').hide();
        // }

        function grand_total() {
            var grandtotal = 0;
            $('input[name^="amount"]').each(function() {

                grandtotal += +$(this).val();

            });
            $('#gr_total').val(grandtotal);
            //   $('#g_total').val(grandtotal);

            $("#order_g_total").text(grandtotal);
            $("#g_total").text(grandtotal);
        }
    </script>
@endsection --}}
{{-- @extends('layouts/app')
@section('styles')
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto@gmail.ocm</td>
                <td><input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled"></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
@endsection


@section('javascript')
    <script>
        $(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
        });
    </script>
@endsection --}}
{{-- <!DOCTYPE html>
<html>

<head>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("select.country").change(function() {
                var selectedCountry = $(this).children("option:selected").val();
                alert("You have selected the country - " + selectedCountry);
                join_ym();
            });

        });

        function join_ym() {
            var yy = document.getElementById('yy').value;
            var mm = document.getElementById('mm').value;

            document.getElementById('joint').value = yy + '-' + mm;

        }
    </script>
    <style>
    </style>
</head>

<body>
    <input type="text" id="yy" onkeyup="join_ym();">
    <label>Select Country:</label>
    <select class="country" id="mm">
        <option value="usa">United States</option>
        <option value="india">India</option>
        <option value="uk">United Kingdom</option>
    </select>
    <input type="text" id="joint" disabled>



</body>

</html> --}}
@extends('layouts/app')
@section('styles')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            font-size: 3.5rem;
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
            margin-bottom: -14px;
        }

        table {
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
        }

        .fieldset {
            border: 2px solid;
            min-height: 176px;
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
                    <div class="col-md-2">
                        <label for="">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm advance_search"
                            id="search" value="{{ $search }}">
                    </div>
                </div>
                <div class="row">
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
                                <button type="button" class="dropdown-item" onclick="prnt_cus('download_excel')">
                                    <i class="fa fa-file-excel-o"></i> Excel Sheet
                                </button>
                            </div>
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
                                        onclick="prnt_cus('pdf')">Print</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle grp_btn"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column"
                                        x-placement="bottom-end">
                                        <button type="button" class="dropdown-item" id=""
                                            onclick="prnt_cus('download_pdf')">
                                            <i class="fa fa-print"></i> Download PDF
                                        </button>
                                        <button type="button" class="dropdown-item"
                                            onclick="prnt_cus('download_excel')">
                                            <i class="fa fa-file-excel-o"></i> Excel Sheet
                                        </button>
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
                                    <p><b>Date:</b> <span class="border-dotted">{{ $info->date }}</span>
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
                url: '/view_qoutations',
                method: 'get',
                datatype: 'json',
                data: {
                    'invoice_id': invoice_id
                },
                success: function(response) {
                    console.log(response.get_info);
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
