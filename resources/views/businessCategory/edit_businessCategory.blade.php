@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Add Business Category</div>
        <div class="card-body">
            <form action="{{ route('update_businessCategory', 'id=' . $edit->business_category_id) }}" method="post"
                id="business_category_form">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Business Category<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off"
                                name="business_category" value="{{ $edit->business_category_name }}"
                                placeholder="Add Business Category">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 31px">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
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
