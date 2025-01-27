@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Visit Type</div>
        <div class="card-body">
            <form action="{{ route('visitTypeUpdate', 'id=' . $get_visit_type->visit_type_id) }}" method="post"
                id="visitTypeEdit">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visit Type<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off"
                                value="{{ $get_visit_type->visit_type_name }}" name="visitType"
                                placeholder="Add Visit Type">
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
            $('#visitTypeEdit').validate({
                rules: {
                    visitType: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                }
            });
        });
    </script>
@endsection
