@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create Product Group</div>
        <div class="card-body">
            <form action="{{ route('productGroupStore') }}" method="post" id="productGroup">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Product Group<span style="color: red">*</span></label>
                            <input type="text" name="product_group_name" value="{{ old('product_group_name') }}"
                                class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="product_group_remarks" class="form-control form-control-sm" cols="30" rows="1">{{ old('product_group_remarks') }}</textarea>
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
            $('#productGroup').validate({
                rules: {
                    product_group_name: {
                        required: true,
                    }
                }
            });
        });
    </script>
@endsection
