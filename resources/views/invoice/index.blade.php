@extends('layouts/app')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">Add Invoice</div>
        <div class="card-body">
            <form action="{{route('storeInvoice')}}" method="post" id="invoice_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" id="date" name="date" autocomplete="off" class="form-control form-control-sm" placeholder="Choose Date...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company</label>
                            <select class="form-control form-control-sm " name="comp_id" id="comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach($comp as $company)
                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product</label>
                            <select class="form-control form-control-sm" name="prod_id" onchange="showDetail(this)" id="prod_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach($prod as $product)
                                    <option value="{{$product->id}}" data-product="{{$product->product_price_sale}}" data-category="{{$product->cat_id}}"
                                            data-bottomPrice="{{$product->product_price_purchase}}" data-unit="{{$product->unit_name}}">
                                        {{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control form-control-sm select2" id="cat_id" name="category" disabled>
                                <option disabled selected hidden>Choose Product</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->cat_id}}">{{$cat->cat_category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Bottom RS/-</label>
                            <input type="text" name="btm_rs" id="btm_rs" class="form-control form-control-sm" readonly/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Total RS/-</label>
                            <input type="number" name="amount" id="amount" class="form-control form-control-sm" readonly/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="text" onkeypress="justNo(event)" name="qty" value="" id="qty" class="form-control form-control-sm"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sale</label>
                            <input type="text" onkeypress="justNo(event)" name="sale" id="sale" value="" class="form-control form-control-sm"/>
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
                    <input type="hidden" name="grand_total" class="form-control form-control-sm" id="gr_total" placeholder="Grand Total">
{{--                    <div class="col-md-12 text-center">--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="button" class="btn btn-primary" id="adding" style="margin-top: 32px" value="Add">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">Invoices
{{--            <button class="btn btn-primary btn-sm float-right" id="prnt" style="display: none" onclick="printContent()">Print</button>--}}
        </div>
        <div id="print">
{{--            <div id="print_info" style="display:none;">--}}
{{--                <br>--}}
{{--                <h1 style="text-align: center;">{{$business_profile->business_profile_name}}</h1>--}}
{{--                <h4 style="text-align: center;">{{$business_profile->business_profile_email}}</h4>--}}
{{--                <h4 style="text-align: center;">{{$business_profile->business_profile_mobile_no}}</h4>--}}
{{--                <br>--}}
{{--                <h6><b>Company: </b><span id="show_comp"></span></h6>--}}
{{--                <h6><b>Date: </b><span id="show_date"></span></h6>--}}
{{--                <br>--}}
{{--            </div>--}}
            <div class="card-body">
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
    </div>
@endsection


@section('javascript')
<script>
        $('#date').datepicker({
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });
        $('.select2').select2();
        var count = 0;
        $(document).ready(function () {
            $('#adding').click(function () {
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
                if(date == ''){
                    $('#date').focus();
                    return;
                }
                if ($('#comp_id')[0].selectedIndex <= 0){
                    $('#comp_id').focus();
                    return;
                }
                if ($('#prod_id')[0].selectedIndex <= 0){
                    $('#prod_id').focus();
                    return;
                }
                if(quantity == ''){
                    $('#qty').focus();
                    return;
                }
                if(sale == ''){
                    $('#sale').focus();
                    return;
                }
                disable_pro(product_id);
                $('#invoice_form').append("<input type='hidden' class='"+count+" product"+count+"' id='prod_id' value='"+product_id+"' name='prod_id[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+" payment_type"+count+"' id='payment_type' value='"+payment_type+"' " +
                    "name='payment_type[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+"' value='"+date+"' name='sale_invoice_date[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+"' id='sale' value='"+sale+"' name='sale[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+"' id='qty' value='"+quantity+"' name='qty[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+"' id='amount' value='"+amount+"' name='amount[]'>");
                $('#invoice_form').append("<input type='hidden' class='"+count+"' id='cat_id' value='"+cat_id+"' name='category[]'>");
                $('#table-body').append("<tr><td>"+product+"</td><td>"+sale+"</td><td>"+quantity+"</td><td>"+amount+"</td><td>"+payment_type+"</td><td><button " +
                    "type='submit' " + "onclick='remove(this, "+count+")' class='btn btn-danger btn-sm rmv2'>Remove</button></td></tr>");
                count++;
                $('#prod_id').val('');
                $('#sale').val('');
                $('#qty').val('');
                $('#amount').val('');
                $('#btm_rs').val('');
                $('#payment_type').val('OTC');
                $("#cat_id").select2("destroy");
                $("#cat_id > option").each(function () {
                    $('#cat_id option:selected').prop('selected', false);
                });
                $('#cat_id').select2();
                $('#comp_id').css('pointer-events','none');
                $('#date').css('pointer-events','none');
                $('#prnt').css('display', 'inline-block');
                grand_total();
                var tableRow = $('#table-body').children().length;
                if (tableRow == 1){
                    $('#noData').hide();
                    $('#invoice-table,#invoiceSubmit,#totalDis').show();
                }
            });
        });

        function disable_pro(value) {
            $('#prod_id option[value='+value+']').attr('disabled', 'disabled');
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
            var multi = quantity*sale;
            $('#amount').val(multi);
            var category = $('option:selected', e).attr('data-category');
            var nameArr = category.split(',');
            $("#cat_id").select2("destroy");
            // $("#cat_id > option").each(function () {
            //     $('#cat_id option:selected').prop('selected', false);
            // });
            $("#cat_id > option").each(function () {
                $.each(nameArr, function (i, val) {
                    $('#cat_id option[value="' + val + '"]').prop('selected', true);
                });
            });
            $("#cat_id").select2();
        }
        $(document).ready(function () {

            $('#qty').keyup(function () {
                var quantity = $('#qty').val();
                var sale = $('#sale').val();
                var multi = quantity*sale;
                $('#amount').val(multi);
            });
            $('#sale').keyup(function () {
                var quantity = $('#qty').val();
                var sale = $('#sale').val();
                var multi = quantity*sale;
                $('#amount').val(multi);
            });
        });

        //deleting selected row index
        function remove(r,row_del) {
            var getting = $('.product'+row_del).val();
            $("#prod_id option").each(function(){
                if($(this).val() == getting){ // EDITED THIS LINE
                    $('#prod_id option[value='+getting+']').attr('disabled', false);
                }
            });
            $('.'+row_del).remove();
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("invoice-table").deleteRow(i);
            count--;
            grand_total();
            var tableRow = $('#table-body').children().length;
            if (tableRow == 0){
                $('#noData').show();
                $('#invoice-table,#invoiceSubmit,#totalDis').hide();
                $('#prnt').css('display', 'none');
            }
        }
        //if table index is 0, it will hide table, submit and grand total
        var tableRow = $('#table-body').children().length;
        if (tableRow == 0){
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
            $('input[name^="amount"]').each(function () {

                grandtotal += +$(this).val();

            });
            $('#gr_total').val(grandtotal);
            //   $('#g_total').val(grandtotal);

            $("#order_g_total").text(grandtotal);
            $("#g_total").text(grandtotal);
        }
    </script>
@endsection
