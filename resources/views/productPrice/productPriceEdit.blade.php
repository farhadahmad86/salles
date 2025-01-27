@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Product</div>
        <div class="card-body">
            <form action="{{ route('productPriceUpdate', 'id=' . $edit->product_price_id) }}" method="post"
                id="Edit_product_price">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product Name<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" name="productName" id="productName">
                                <option value="" selected>Choose Product</option>
                                @foreach ($product as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $edit->product_price_product_id ? 'selected' : '' }}>
                                        {{ $item->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sale<span style="color: red">*</span></label>
                            <input type="number" class="form-control form-control-sm" id=""
                                value="{{ $edit->product_price_sale }}" name="sale">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Bottom Price<span style="color: red">*</span></label>
                            <input type="number" class="form-control form-control-sm" id=""
                                value="{{ $edit->product_price_purchase }}" name="purchase">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m">Submit</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function() {
            $('#productName').select2();
            $('#Edit_product_price').validate({
                rules: {
                    productName: {
                        required: true,
                    },
                    sale: {
                        required: true,
                        digits: true,
                    },
                    purchase: {
                        required: true,
                        digits: true,
                    },
                }
            });
        });

        tinymce.init({ //tinymce(texteditor)
            selector: '#pro_description',
            plugins: 'lists',
            menubar: "insert",
            content_style: 'p {margin: 0px;}',
            width: '100%',
            height: 140
        });
    </script>
@endsection
