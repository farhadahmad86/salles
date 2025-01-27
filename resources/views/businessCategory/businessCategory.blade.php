@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Business Category</div>
        <div class="card-body">
            <form action="{{ route('store_businessCategory') }}" method="post" id="business_category_form">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Business Category<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off"
                                name="business_category" placeholder="Add Business Category">
                        </div>
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
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('document').ready(function() {
            $('#business_category_form').validate({
                rules: {
                    business_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                }
            });
        });
    </script>
@endsection
