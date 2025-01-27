@extends('layouts/app')
@section('styles')
    <style>
        .table-purpal thead {
            background-color: #6C79E0;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('store_version') }}" method="post" id="invoice_form">
        <div class="card">
            <div class="card-header">Add Quotation</div>
            <div class="card-body">

                @csrf
                <input type="hidden" name="id" value="{{ $invoice->id }}">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject">Subject Id</label>
                            <input type="text" id="unique_id" name="unique_id" autocomplete="off"
                                class="form-control form-control-sm" value="{{ $invoice->unique_id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: none">
                        <div class="form-group">
                            <label for="subject">Subject<span style="color: red">*</span></label>
                            <input type="text" id="subject" name="subject" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose Subject..."
                                value="{{ $invoice->subject }}" required readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject">Previous Version<span style="color: red">*</span></label>
                            <input type="text" id="subject" name="p_version" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose Subject..."
                                value="{{ $invoice->version }}" required readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Previous Version Date<span style="color: red">*</span></label>
                            <input type="text" id="" name="P-version_date" autocomplete="off"
                                class="form-control form-control-sm" value="{{ $invoice->inv_date }}" readonly>
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Current Version<span style="color: red">*</span></label>
                            <input type="text" id="" name="c_version" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose" value="{{ $last_version }}">
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Current Version Date<span style="color: red">*</span></label>
                            <input type="text" id="date" name="date" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">POC<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="poc" id="poc">
                                @foreach ($poc as $all_poc)
                                    <option value="{{ $all_poc->com_poc_profile_id }}"
                                        {{ $all_poc->com_poc_profile_id == $invoice->poc_id ? 'selected' : '' }}>
                                        {{ $all_poc->com_poc_profile_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: none">
                        <div class="form-group">
                            <label for="">Company<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="comp_id" id="comp_id" readonly>
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($comp as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $company->id == $invoice->company_id ? 'selected' : '' }}
                                        {{ $company->id != $invoice->company_id ? 'disabled' : '' }}>
                                        {{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="prod_id" onchange="showDetail(this)"
                                id="prod_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($prod as $product)
                                    <option value="{{ $product->id }}" data-product="{{ $product->product_price_sale }}"
                                        data-category="{{ $product->cat_id }}"
                                        data-bottomPrice="{{ $product->product_price_purchase }}"
                                        data-unit="{{ $product->unit_name }}"
                                        data-description="{{ $product->description }}">
                                        {{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="quotation_remarks">Remarks<span style="color: red">*</span></label>
                            <input type="text" id="quotation_remarks" name="quotation_remarks" autocomplete="off"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-2" style="display: none">
                        <div class="form-group">
                            <label for="">Category<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" id="cat_id" name="category" disabled>
                                <option disabled selected hidden>Choose Product</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->cat_id }}">{{ $cat->cat_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Bottom RS<span style="color: red">*</span></label>
                            <input type="text" name="btm_rs" id="btm_rs" class="form-control form-control-sm"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Total RS<span style="color: red">*</span></label>
                            <input type="number" name="amount" id="amount" class="form-control form-control-sm"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">UOM<span style="color: red">*</span></label>
                            <input type="text" name="unit" id="unit" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Quantity<span style="color: red">*</span></label>
                            <input type="text" onkeypress="justNo(event)" name="qty" value="" id="qty"
                                class="form-control form-control-sm" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sale<span style="color: red">*</span></label>
                            <input type="text" name="sale" id="sale" value="" onkeypress="justNo(event)"
                                class="form-control form-control-sm" />
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Payment Type<span style="color: red">*</span></label>
                            <select name="payment_type" id="payment_type" class="form-control form-control-sm">
                                <option value="OTC">OTC</option>
                                <option value="MRC">MRC</option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col">
                        {{-- <input type="button" class="btn btn-primary btn-sm btn-top-m" id="adding" value="Add"> --}}
                    {{-- </div> --}}
                    <input type="hidden" name="grand_total" class="form-control form-control-sm" id="gr_total"
                        placeholder="Grand Total">
                    {{--                    <div class="col-md-12 text-center"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <input type="button" class="btn btn-primary" id="adding" style="margin-top: 32px" value="Add"> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                </div>

            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">Quotations
                {{--            <button class="btn btn-primary btn-sm float-right" id="prnt" style="display: none" onclick="printContent()">Print</button> --}}
            </div>
            <div id="print">
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
                <div class="card-body">
                    {{-- <h3 style="text-align: center" id="noData">No Data Found</h3> --}}
                    <table class="table table-purpal table-bordered table-hover table-striped" id="invoice-table">
                        <thead id="t_head">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th style="width: 10%;">Quantity</th>
                                <th style="width: 10%;">UOM</th>
                                <th style="width: 10%;">Price</th>
                                <th style="width: 10%;">Total Amount</th>
                                <th style="width: 10%;">Payment Type</th>
                                <th style="width: 5%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">

                        </tbody>
                    </table>
                    <p class="text-right" id="totalDis">Grand Total: <b id="g_total"></b></p>

                </div>
            </div>
        </div>
        <div class="card
        mt-5" style="display: none" id="tandc_div">
            <div class="card-header">Products Info / Term and Condition</div>
            <div class="card-body" style="position: relative">
                @foreach ($all_tandc as $tandc)
                    <div style="position: absolute"><input type="checkbox" class="tandc_checkbox" name="tandc"
                            id="term{{ $tandc->tandc_id }}" value="{{ $tandc->tandc_id }}"
                            {{ $tandc->tandc_id == $invoice->tandc_id ? 'checked' : '' }}>
                    </div>
                    <label for="term{{ $tandc->tandc_id }}" style="padding-left: 30px;"><span
                            style="font-weight: 700">{{ $tandc->tandc_title }}</span><span
                            style="font-weight: 400">{!! $tandc->tandc_description !!}</span>
                    </label>
                    <hr>
                @endforeach
                <button type="submit" class="btn btn-primary t float-right rmv3 check_terms"
                    id="invoiceSubmit">Submit</button>
            </div>
        </div>
        <input type="hidden" name="tandc" id="tandc" value="">
    </form>
@endsection



@section('javascript')
    <script>
        var i = 1;

        $('document').ready(function() {
            $('#poc').select2();
            $('.tandc_checkbox').click(function() {
                var checkboxstore = [];
                $.each($('input[name="tandc"]:checked'), function() {
                    checkboxstore.push($(this).val());
                });
                $('#tandc').val(checkboxstore);
                console.log(checkboxstore);
            });
            $('.check_terms').click(function() {
                if ($('input[name="tandc"]:checked').length == 0) {
                    alert('Plz choose any Term and Condition');
                    return false;
                }
            });
            $('#invoice_form').validate({
                rules: {
                    subject: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    comp_id: {
                        required: true,
                    },
                    quotation_remarks: {
                        required: true,
                    },
                }
            });
        });
        // $('#date').datepicker({
        //     minDate: new Date(),
        //     dateFormat: 'dd-mm-yy'
        // });

        $('#prod_id').select2();
        var count = 0;
        $(document).ready(function() {
            // str_replace("\\", "\\\\", $invoice_items);
            var inv_item = {!! str_replace(["\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"], '<p></p>', $invoice_items) !!}
            // var inv_item = JSON.parse('{!! json_encode($invoice_items) !!}');
            console.log(inv_item);

            inv_item.forEach(element => {
                console.log(element);
                // var subject = $('#subject').val();
                // var company = $('#comp_id option:selected').text();
                var product_id = element.product_id;
                var product = element.product_name;
                var payment_type = element.payment_type;
                var sale = element.sale;
                var quantity = element.qty;
                var amount = element.total_amount;
                var date = element.date;
                var cat_id = element.category_id;
                var description = element.description;
                var bottom_price = element.product_price_purchase;
                var unit = element.unit_name;

                disable_pro(product_id);
                // $('#invoice_form').append(
                //     `<input type='text' class='${count} product${count}' id='prod_id' value='${product_id}' name='prod_id[]'>`
                // );
                // $('#invoice_form').append(
                //     `<input type='hidden' class='${count} payment_type${count}' id='payment_type' value='${payment_type}' "name='payment_type[]'>`
                // );
                // $('#invoice_form').append(
                //     `<input type='hidden' class='${count}' id='sale' value='${sale}' name='sale[]'>`);
                // $('#invoice_form').append(
                //     `<input type='hidden' class='${count}' id='qty' value='${quantity}' name='qty[]'>`);
                // $('#invoice_form').append(
                //     `<input type='hidden' class='${count}' id='amount' value='${amount}' name='amount[]'>`
                // );
                // $('#invoice_form').append(
                //     `<input type='hidden' class='${count}' id='cat_id' value='${cat_id}' name='category[]'>`
                // );
                $('#table-body').append(
                    `<tr>
                <td> ${i} </td>
                <td><input type='hidden' name='prod_id[]' value='${product_id}'> ${product}
                </td>
                <td><input type='hidden' name='prod_description' value='${description}'> ${description}
                </td>
                <input type='hidden' class='${count}' id='cat_id' value='${cat_id}' name='category[]'>
                <td><input type='text' name='qty[]' id='qty${count}' class='form-control form-control-sm' onkeyup='updateTotal(${count})'  value='${quantity}'>
                </td>
                <td> <input type='hidden' name='uom[]' value='${unit}'> ${unit}  </td>
                <td> <input type="hidden" name="btm_rs" id="btm_rs${count}" value='${bottom_price}' class='form-control form-control-sm' readonly>
                    <input type='text' name='sale[]' id='sale${count}' class='form-control form-control-sm' data-toggle='tooltip' title='Bottom Price is ${bottom_price}' onkeyup='updateTotal(${count})' onfocusout='changePrice(${count}),updateTotal(${count})'  class='form-control form-control-sm' value='${sale}'>
                </td>
                <td><input type='hidden' id='amount${count}' value='${amount}' name='amount[]' >
                     <span id='t_amount${count}'> ${amount} </span>
                </td>
                <td><select name='payment_type[]' id='payment_type' class='form-control form-control-sm'>
                <option value = 'OTC'> OTC </option>
                <option value = 'MRC'> MRC </option>
                 </select ></td>
                <td> <button
                type='submit'  onclick='remove(this,  ${count}
                )' class='btn btn-danger btn-sm rmv2'><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>`
                );
                i++;
                count++;
                $(
                    '#prod_id').val('');

                $('#prnt').css('display',
                    'inline-block');
                $('#tandc_div').css('display', 'block');
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

            var date = $('#date').val();
            console.log(date);
            var salePrice = $('option:selected', e).attr('data-product');
            var cat_id = $('option:selected', e).attr('data-category');
            var bottom_price = $('option:selected', e).attr('data-bottomPrice');
            var description = $('option:selected', e).attr('data-description');
            var unit = $('option:selected', e).attr('data-unit');
            var product_id = $('#prod_id option:selected').val();
            var product = $('#prod_id option:selected').text();
            var payment_type = 'OTC';
            var sale = salePrice;
            var quantity = 1;
            var amount = salePrice * quantity;
            disable_pro(product_id);

            $('#table-body').append(

                `<tr>
                <td> ${i} </td>
                <td><input type='hidden' name='prod_id[]' value='${product_id}'> ${product}
                </td>
                <td><input type='hidden' name='prod_description' value='${description}'> ${description}
                </td>
                <input type='hidden' class='${count}' id='cat_id' value='${cat_id}' name='category[]'>
                <td><input type='text' name='qty[]' id='qty${count}' class='form-control form-control-sm' onkeyup='updateTotal(${count})'  value='${quantity}'>
                </td>
                <td> <input type='hidden' name='uom[]' value='${unit}'> ${unit}  </td>
                <td> <input type="hidden" name="btm_rs" id="btm_rs${count}" value='${bottom_price}' class='form-control form-control-sm' readonly>
                    <input type='text' name='sale[]' id='sale${count}' class='form-control form-control-sm' data-toggle='tooltip' title='Bottom Price is ${bottom_price}' onkeyup='updateTotal(${count})' onfocusout='updateTotal(${count}),changePrice(${count})'  class='form-control form-control-sm' value='${sale}'>
                </td>
                <td><input type='hidden' id='amount${count}' value='${amount}' name='amount[]' >
                     <span id='t_amount${count}'> ${amount} </span>
                </td>
                <td><select name='payment_type[]' id='payment_type' class='form-control form-control-sm'>
                <option value = 'OTC' > OTC </option>
                <option value = 'MRC' > MRC </option>
                 </select ></td>
                <td> <button
                type='submit'  onclick='remove(this,  ${count}
                )' class='btn btn-danger btn-sm rmv2'><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>`
            );
            count++;
            i++;

            $('#prnt').css('display', 'inline-block');
            grand_total();
            var tableRow = $('#table-body').children().length;
            if (tableRow == 1) {
                // $('#noData').hide();
                $('#invoice-table,#invoiceSubmit,#totalDis').show();
            }


        }
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function updateTotal(count) {
            var sale = parseFloat($('#sale' + count).val());
            var qty = parseFloat($('#qty' + count).val());
            let total_amount = sale * qty;
            $('#amount' + count).val(total_amount);
            $('#t_amount' + count).html(total_amount);
            grand_total();
        }

        function changePrice(id) {
            let sale = parseFloat($('#sale' + id).val());
            let botmprice = parseFloat($('#btm_rs' + id).val());

            console.log(sale, botmprice);
            if (sale <= botmprice) {
                $('#sale' + id).val(botmprice);
                // $('#sale').css('background-color', 'red');
            }
            grand_total();
        }

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
                $('#t_head').show();
                $('#invoice-table,#invoiceSubmit,#totalDis').hide();
                $('#prnt').css('display', 'none');
            }
        }
        //if table index is 0, it will hide table, submit and grand total
        var tableRow = $('#table-body').children().length;
        if (tableRow == 0) {
            $('#invoiceSubmit,#totalDis').hide();
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
        var d = new Date();
        var yr = d.getFullYear();
        var month = d.getMonth() + 1;

        if (month < 10) {
            month = '0' + month;
        }
        var date = d.getDate();
        if (date < 10) {
            date = '0' + date;
        }
        var c_date = `${yr}-${month}-${date}`;

        document.getElementById('date').value = c_date;
    </script>
@endsection
