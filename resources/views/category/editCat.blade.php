@extends('layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Product Category</div>
        <div class="card-body">
            <form action="{{ route('updateCategory', 'id=' . $edit_category->cat_id) }}" method="post" id="Edit_categpy">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Product Group<span style="color: red">*</span></label>
                        <select name="product_group" id="" class="form-control form-control-sm">
                            @foreach ($product_group as $item)
                                <option value="{{ $item->product_group_id }}"
                                    {{ $item->product_group_id == $edit_category->cat_product_group_id ? 'selected' : '' }}>
                                    {{ $item->product_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off"
                                value="{{ $edit_category->cat_category }}" name="category">
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
        // Farhad
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('sector') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#Edit_categpy').validate({
                // ignore: [],
                rules: {
                    product_group: {
                        required: true,
                    },
                    category: {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
