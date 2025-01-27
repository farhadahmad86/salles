@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Add Status</div>
        <div class="card-body">
            <form action="{{ route('storeStatus') }}" method="post" id="status_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" name="status"
                                placeholder="Add Status">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('document').ready(function() {
            $('#status_form').validate({
                rules: {
                    status: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                }
            });
        });
    </script>
@endsection
