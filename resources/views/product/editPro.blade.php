@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Product</div>
        <div class="card-body">
            <form action="{{ route('updateProduct', 'id=' . $edit->id) }}" method="post" id="edit_product">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Product Group<span style="color: red">*</span></label>
                                <select class="form-control form-control-sm select2" name="pro_group" id="product_group">
                                    <option selected disabled hidden>Choose Product Group</option>
                                    @foreach ($pro_group as $pro_groups)
                                        <option value="{{ $pro_groups->product_group_id }}"
                                            {{ $edit->pro_group_id == $pro_groups->product_group_id ? 'selected' : '' }}>
                                            {{ $pro_groups->product_group_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Category<span style="color: red">*</span></label>
                                <select class="form-control form-control-sm select2" name="category" id="product_category">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->cat_id }}"
                                            {{ $edit->cat_id == $cat->cat_id ? 'selected' : '' }}>{{ $cat->cat_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id=""
                                value="{{ $edit->product_name }}" name="productName">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form_group">
                            <label for="">Unit Of Measurement<span style="color: red">*</span></label>
                            <select name="unit" id="unit" class="form-control form-control-sm">
                                <option disabled selected hidden>Choose</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->unit_id }}"
                                        {{ $item->unit_id == $edit->product_unit ? 'selected' : '' }}>
                                        {{ $item->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select name="prod_status" class="form-control form-control-sm" id="">
                                <option disabled hidden selected>Choose Status</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}"
                                        {{ $item->sta_id == $edit->product_status ? 'selected' : '' }}>
                                        {{ $item->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Description<span style="color: red">*</span></label>
                            <textarea name="description" id="editor" class="form-control form-control-sm textarea" cols="30"
                                rows="1">{{ $edit->description }}</textarea>
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
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        $('document').ready(function() {
            $('#product_group').select2();
            $('#product_category').select2();
            $('#unit').select2();
            $('#edit_product').validate({
                rules: {
                    category: {
                        required: true,
                    },
                    productName: {
                        required: true,
                    },
                }
            });
        });
        //  farhad
        $('#product_group').change(function() {
            var pro_group_id = $(this).children('option:selected').val();
            $.ajax({
                url: '{{ route('get_cat')}}',
                method: 'GET',
                datatype: 'text',
                data: {
                    'pro_group_id': pro_group_id
                },
                success: function(response) {
                    console.log(response);
                    $('#product_category').html(response);
                }
            })
        });
        // tinymce.init({ //tinymce(texteditor)
        //     selector: '#pro_description',
        //     plugins: 'lists',
        //     menubar: "insert",
        //     content_style: 'p {margin: 0px;}',
        //     width: '100%',
        //     height: 140
        // });
    </script>
     <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {

                console.error(editor);
            })
            .catch(error => {
                console.error(error);
            });
</script>
@endsection
