@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create Order</div>
        <div class="card-body">
            <form action="{{ route('storeOrder') }}" method="post" id="create_order">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Date:</label>
                            <input type="text" id="date" name="date" value=""
                                class="form-control form-control-sm" autocomplete="off" placeholder="Choose Date..." />
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Subject Id</label>
                            <select class="form-control form-control-sm" name="comp_id" id="order_porposal_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($quotations as $name)
                                    <option value="{{ $name->id }}">
                                        {{ $name->unique_id }}------V-{{ $name->version }}</span>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Subject Id</label>
                            <select class="form-control form-control-sm" name="comp_id" id="order_comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($quotations as $name)
                                    <option value="{{ $name->unique_id }}">
                                        {{ $name->unique_id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Quotation No</label>
                            <select class="form-control form-control-sm" name="purposal_list" id="order_porposal_id">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-none">
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
                    <div class="col-md-2 d-none">
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" class="form-control form-control-sm" id="unit"
                                readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="order_product_list">
                    <div class="col-md-12 mb-3 mt-3 text-center" id="add_product_btn" style="display: none">
                        {{--                        <h3 class="text-center">Add More Products</h3> --}}
                        <button class="btn btn-success btn-sm">Add Products</button>
                    </div>
                    <div id="add_product" style="display: none">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Product</label>
                                <select class="form-control form-control-sm" name="prod_id"
                                    onchange="order_showDetail(this)" id="order_prod_id">
                                    <option disabled hidden selected>Choose...</option>
                                    @foreach ($all_product as $product)
                                        <option value="{{ $product->id }}"
                                            data-product="{{ $product->product_price_sale }}"
                                            data-category="{{ $product->cat_id }}"
                                            data-description="{{ $product->description }}"
                                            data-bottomPrice="{{ $product->product_price_purchase }}"
                                            data-unit="{{ $product->unit_name }}" data-unit_id="{{ $product->unit_id }}">
                                            {{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="text" onkeypress="justNo(event)" name="qty" value=""
                                    id="order_qty" class="form-control form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Sale</label>
                                <input type="text" onkeypress="justNo(event)" name="sale" id="order_sale"
                                    value="" class="form-control form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Bottom RS/-</label>
                                <input type="text" name="btm_rs" id="btm_rs" class="form-control form-control-sm"
                                    readonly />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Total RS/-</label>
                                <input type="number" name="amount" id="order_amount" class="form-control form-control-sm"
                                    readonly />
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
                        {{--                        <div class="col-md-1"> --}}
                        {{--                            <div class="form-group"> --}}
                        {{--                                <input type="button" class="btn btn-primary" id="product_adding" style="margin-top: 32px" value="Add"> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="col-md-1"> --}}
                        {{--                            <div class="form-group"> --}}
                        {{--                                <input type="button" class="btn btn-danger" id="cancel_btn" style="margin-top: 32px" value="Cancel"> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 pro_description" style="display:none;">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea id="pro_description" class="form-control form-control-sm textarea" cols="30" rows="8"></textarea>
                    </div>
                </div>
                <div class="text-center" id="add_cancel" style="display: none">
                    <input type="button" class="btn btn-primary" id="product_adding" style="margin-top: 32px"
                        value="Add">
                    <input type="button" class="btn btn-danger" id="cancel_btn" style="margin-top: 32px"
                        value="Cancel">
                </div>
                <input type="hidden" name="grand_total" id="gr_total">
                <input type="hidden" name="tandc" id="tandc" value="">
                <input type="hidden" name="unit_id" id="unit_id">
            </form>
        </div>
    </div>
    <div class="card mt-5" id="order_table_div" style="display: none">
        <div class="card-header">Products

            {{--            <button type="button" class="btn btn-secondary btn-sm float-right mr-2" id="prnt" onclick="printContent('print')">Print</button> --}}
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
                <table class="table" id="order_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Sale</th>
                            <th>Total</th>
                            <th>Payment Type</th>
                            <th class="rmv1">Edit</th>
                            <th class="rmv1">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="from_product">

                    </tbody>
                    <tbody id="from_purposal">

                    </tbody>
                </table>
                <p class="text-right" id="order_totalDis">Grand Total: <b id="order_g_total"></b></p>
                <hr>
                <button type="submit" class="btn btn-primary mb-3 btn-sm float-right" id="check_terms"
                    form="create_order">Submit</button>
            </div>
        </div>
    </div>

    <div class="card mt-5" style="display: none" id="tandc_div">
        <div class="card-header">Products Info / Term and Condition</div>
        <div class="card-body" style="position: relative">
            @foreach ($all_tandc as $tandc)
                <div style="position: absolute"><input type="checkbox" class="tandc_checkbox" name="tandc"
                        value="{{ $tandc->tandc_id }}"></div>
                <div style="padding-left: 30px;"><b>{{ $tandc->tandc_title }}</b>{!! $tandc->tandc_description !!}</div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection


@section('javascript')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#order_comp_id').select2();
            $('#order_porposal_id').select2();
            $('.tandc_checkbox').click(function() {
                var checkboxstore = [];
                $.each($('input[name="tandc"]:checked'), function() {
                    checkboxstore.push($(this).val());
                });
                $('#tandc').val(checkboxstore);
            });
        });
        $('#create_order').validate({
            rules: {
                date: {
                    required: true,
                },
                comp_id: {
                    required: true,
                },
                purposal_list: {
                    required: true,
                },
            }
        });
        //createOrder   getting purposals list after click on company id
        $('#order_comp_id').change(function() {
            var company_id = $('#order_comp_id option:selected').val();
            $.ajax({
                url: '{{ route('get_purposal') }}',
                method: 'get',
                datatype: 'text',
                data: {
                    'company_id': company_id,
                },
                success: function(response) {
                    $('#order_porposal_id').html(response);
                }
            })
        });

        //getting all purposal after click on purposal dropdown item
        window.added = 0;
        $('#order_porposal_id').change(function() {
            if ($('#add_product').css('display') === 'none') {
                $('#add_product_btn').show();
            }
            if ($('#add_product').css('display') !== 'none') {
                $('#add_product_btn').hide();
            }
            // $('#order_product_list').show();
            $('#order_table_div').show();
            var order_porposal_id = $('#order_porposal_id option:selected').val();
            console.log(order_porposal_id);
            $.ajax({
                url: '{{ route('purposal_lists') }}',
                method: 'get',
                datatype: 'json',
                data: {
                    'order_porposal_id': order_porposal_id,
                },
                success: function(response) {
                    console.log(response);
                    $('#from_purposal').html('');
                    for (var i = 0; i < response.return_purposal_lists.length; i++) {
                        $('#from_purposal').append(
                            '<tr>' + response.return_purposal_lists[i] + '</tr>'
                        );
                    }
                    var plus = 0;
                    if (added == 1) {
                        $.each(product, function() {
                            $('#order_prod_id option[value=' + product[plus] + ']').attr(
                                'disabled', false);
                            plus++;
                            added = 0;
                        });
                    }
                    plus = 0;
                    $.each(response.product_id, function() {
                        window.product = response.product_id;
                        $('#order_prod_id option[value=' + response.product_id[plus] + ']')
                            .attr('disabled', 'disabled');
                        plus++;
                        added = 1;
                    });

                    grand_total();
                    $('#show_comp').text($('#order_comp_id option:selected').text());
                    $('#show_date').text($('#date').val());
                    $('#tandc_div').show();
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            });

            $('#add_product_btn').click(function() {
                $('#add_cancel').show();
                $('#add_product').show();
                $('#add_product').addClass(['d-flex']);
                $('#add_product_btn').hide();
                return false;
            });


            $('#cancel_btn').click(function() {
                $('#add_product').removeClass(['d-flex']);
                $('#add_cancel').hide();
                $('#add_product').hide();
                $('#add_product_btn').show();
                $('.pro_description').hide();
            })

            // getting product list after click on purposal dropdown item
            //     $.ajax({
            //         url: '{{ route('get_product_list') }}',
            //         method: 'get',
            //         datatype: 'text',
            //         success: function (response) {
            //             $('#order_prod_id').html(response);
            //         }
            //     })
        });


        //add Product in order table
        var count = 0;
        $('#product_adding').click(function() {
            var botm = $('#btm_rs').val();
            var product_id = $('#order_prod_id option:selected').val();
            var product = $('#order_prod_id option:selected').text();
            tinyMCE.triggerSave();
            var product_desc = $('#pro_description').val();
            var sale = $('#order_sale').val();
            var quantity = $('#order_qty').val();
            var amount = $('#order_amount').val();
            var date = $('#date').val();
            var cat_id = $('#cat_id').val();
            var payment_type = $('#payment_type').val();
            $('#show_comp').text($('#order_comp_id option:selected').text());
            $('#show_date').text(date);
            if (date == '') {
                $('#date').focus();
                return;
            }
            if ($('#order_prod_id')[0].selectedIndex <= 0) {
                $('#order_prod_id').focus();
                return;
            }
            if (quantity == '') {
                $('#order_qty').focus();
                return;
            }
            if (sale == '') {
                $('#order_sale').focus();
                return;
            }
            order_disable_pro(product_id);
            $('#create_order').append("<input type='hidden' class='order_" + count + " botm" + count +
                "' id='btm_rs' value='" + botm + "'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " prod" + count +
                "' id='order_prod_id' value='" + product_id + "' name='prod_id[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " payment_type" + count +
                "' id='payment_type' value='" + payment_type + "' name='payment_type[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " prod_description" + count +
                "' id='order_prod_description' value='" + product_desc + "' name='prod_description[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " sale" + count +
                "' id='order_sale' value='" + sale + "' name='sale[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " qty" + count +
                "' id='order_qty' value='" + quantity + "' name='qty[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " amount" + count +
                "' id='order_amount' value='" + amount + "' name='amount[]'>");
            $('#create_order').append("<input type='hidden' class='order_" + count + " category" + count +
                "' id='cat_id' value='" + cat_id + "' name='category[]'>");
            $('#from_product').append("<tr><td>" + product + "<br>" + product_desc + "</td><td>" + quantity +
                "</td><td>" + sale + "</td><td>" + amount + "</td><td>" + payment_type + "</td><td " +
                "class='rmv1'><button type='button' " +
                "onclick='order_edit" +
                "(this, " + "" + count + ")' " + "class='btn" +
                " btn-primary btn-sm'>Edit</button></td><td class='rmv1'><button type='button' onclick='order_remove(this, " +
                count + ")' class='btn" +
                " btn-danger btn-sm'>Remove</button></td></tr>");
            count++;
            $('#order_prod_id').val('');
            $('#order_sale').val('');
            $('#order_qty').val('');
            $('#order_amount').val('');
            $('#btm_rs').val('');
            $('#prnt').css('display', 'inline-block');
            $("#cat_id").select2("destroy");
            $("#cat_id > option").each(function() {
                $('#cat_id option:selected').prop('selected', false);
            });
            $('#cat_id').select2();
            grand_total();
            tinyMCE.activeEditor.setContent('');
            $('.pro_description').hide();
            // var tableRow = $('#table-body').children().length;
            // if (tableRow == 1){
            //     $('#noData').hide();
            //     $('#invoice-table,#invoiceSubmit,#totalDis').show();
            // }

            if (update_name == 1) {
                $('#product_adding').prop('value', 'Add');
                $('#product_adding').addClass('btn btn-primary').removeClass('btn-success');
                $('#order_table').find("*").attr('disabled', false);
                $('#order_qty').prop('placeholder', '');
                $('#order_sale').prop('placeholder', '');
                tinyMCE.activeEditor.setContent('');
                $('.pro_description').hide();
                update_name = 0;
            }
            $('#cancel_btn').show();
        });

        function order_disable_pro(value) {
            $('#order_prod_id option[value=' + value + ']').attr('disabled', 'disabled');
        }


        $('#order_qty').keyup(function() {
            var quantity = $('#order_qty').val();
            var sale = $('#order_sale').val();
            var multi = quantity * sale;
            $('#order_amount').val(multi);
        });
        $('#order_sale').keyup(function() {
            var quantity = $('#order_qty').val();
            var sale = $('#order_sale').val();
            var multi = quantity * sale;
            $('#order_amount').val(multi);
        });

        //if table index is 0, it will hide table, submit and grand total
        //     var tableRow = $('#order_table').children().length;
        //     if (tableRow == 0){
        //         $('#invoice-table,#invoiceSubmit,#totalDis').hide();
        //     }

        //edit selected product row index
        var update_name = 0;

        function order_edit(row, row_edit) {
            var botm = $('.botm' + row_edit).val();
            var product = $('.prod' + row_edit).val();
            var sale = $('.sale' + row_edit).val();
            var qty = $('.qty' + row_edit).val();
            var amount = $('.amount' + row_edit).val();
            var product_description = $('.prod_description' + row_edit).val();
            $('#cancel_btn').hide();
            $('.pro_description').show();
            tinyMCE.activeEditor.setContent(product_description);
            $('#order_prod_id').val(product);
            $('#order_qty').val(qty);
            $('#order_sale').val(sale);
            $('#order_amount').val(amount);
            $('#btm_rs').val(botm);
            $('#order_qty').prop('placeholder', qty);
            $('#order_sale').prop('placeholder', sale);

            $('#product_adding').prop('value', 'Update');
            $('#product_adding').addClass('btn btn-success').removeClass('btn-primary');
            update_name = 1;
            // enable selected product in dropdown
            var getting = $('.prod' + row_edit).val();
            $("#order_prod_id option").each(function() {
                if ($(this).val() == getting) { // EDITED THIS LINE
                    $('#order_prod_id option[value=' + getting + ']').attr('disabled', false);
                }
            });
            //delete full row
            $('.order_' + row_edit).remove();
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("order_table").deleteRow(i);
            grand_total();
            $('#order_table').find("*").attr("disabled", "disabled");
        }

        function edit_order_row(row, row_edit) {
            var botm = $('.p_botm' + row_edit).val();
            var product = $('.p_prod' + row_edit).val();
            var sale = $('.p_sale' + row_edit).val();
            var qty = $('.p_qty' + row_edit).val();
            var amount = $('.p_amount' + row_edit).val();
            var prod_des = $('.p_prod_desc' + row_edit).val();
            $('#add_product_btn').hide();
            $('#add_product').show();
            $('#add_product').addClass('d-flex');
            $('#cancel_btn').hide();
            $('.pro_description').show();
            tinyMCE.activeEditor.setContent(prod_des);
            $('#order_prod_id').val(product);
            $('#order_qty').val(qty);
            $('#order_sale').val(sale);
            $('#order_amount').val(amount);
            $('#btm_rs').val(botm);
            $('#order_qty').prop('placeholder', qty);
            $('#order_sale').prop('placeholder', sale);
            $('#add_cancel').show();
            $('#product_adding').prop('value', 'Update');
            $('#product_adding').addClass('btn btn-success').removeClass('btn-primary');

            update_name = 1;
            // enable selected product in dropdown
            var getting = $('.prod' + row_edit).val();
            $("#order_prod_id option").each(function() {
                if ($(this).val() == getting) { // EDITED THIS LINE
                    $('#order_prod_id option[value=' + getting + ']').attr('disabled', false);
                }
            });
            //delete full row
            $('.' + row_edit).remove();
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("order_table").deleteRow(i);
            grand_total();
            $('#order_table').find("*").attr("disabled", "disabled");
        }

        //deleting product selected row index
        function order_remove(r, row_del) {
            var getting = $('.prod' + row_del).val();
            $("#order_prod_id option").each(function() {
                if ($(this).val() == getting) { // EDITED THIS LINE
                    $('#order_prod_id option[value=' + getting + ']').attr('disabled', false);
                }
            });
            $('.order_' + row_del).remove();
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("order_table").deleteRow(i);
            count--;
            grand_total();
            var tableRow = $('#order_table').children().length;
            if (tableRow == 0) {
                // $('#noData').show();
                // $('#invoice-table,#invoiceSubmit,#totalDis').hide();
                $('#prnt').css('display', 'none');
            }
        }

        function order_showDetail(e) {
            var salePrice = $('option:selected', e).attr('data-product');
            var bottom_price = $('option:selected', e).attr('data-bottomPrice');
            var pro_description = $('option:selected', e).attr('data-description');
            var unit = $('option:selected', e).attr('data-unit');
            var unit_id = $('option:selected', e).attr('data-unit_id');
            $('#order_sale').val(salePrice);
            $('#btm_rs').val(bottom_price);
            $('#unit').val(unit);
            $('#unit_id').val(unit_id);
            var quantity = $('#order_qty').val();
            var sale = $('#order_sale').val();
            var multi = quantity * sale;
            $('#order_amount').val(multi);
            $('.pro_description').show();
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
            tinyMCE.activeEditor.setContent(pro_description);
        }

        //delete order purposal row
        function delete_order_row(row, del_row) {
            var getting = $('.p_prod' + del_row).val();
            $("#order_prod_id option").each(function() {
                if ($(this).val() == getting) {
                    $('#order_prod_id option[value=' + getting + ']').attr('disabled', false);
                }
            });
            $('.' + del_row).remove();
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById('order_table').deleteRow(i);
            grand_total();
        }

        function grand_total() {
            var grandtotal = 0;
            $('input[name^="amount"]').each(function() {

                grandtotal += +$(this).val();

            });
            $('#gr_total').val(grandtotal);
            //   jQuery('#g_total').val(grandtotal);

            $("#order_g_total").text(grandtotal);
            $("#g_total").text(grandtotal);
        }

        // For Print
        // function printContent(el)
        // {
        //     $('.rmv1').hide();
        //     $('#print_info').show();
        //     var restorepage=document.body.innerHTML;
        //     var printcontent=document.getElementById(el).innerHTML;
        //     document.body.innerHTML=printcontent;
        //     window.print();
        //     document.body.innerHTML=restorepage;
        //     $('.rmv1').show();
        //     $('#print_info').hide();
        // }

        $('#check_terms').click(function() {
            if ($('input[name="tandc"]:checked').length == 0) {
                alert('Plz choose any Term and Condition');
                return false;
            }
        });

        // tinymce.init({ //tinymce(texteditor)
        //     selector: '#pro_description',
        //     plugins: 'lists',
        //     menubar: "insert",
        //     content_style: 'p {margin: 0px;}',
        //     width: '100%',
        //     height: 140
        // });
        // $(document).ready(function(){
        $('#date').datepicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY HH:mm:ss'
        });
        // });
    </script>
@endsection
