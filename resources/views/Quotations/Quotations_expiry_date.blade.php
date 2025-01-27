@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Update Days</div>
        <div class="card-body">
            <form action="{{ route('update_expiry_days', 'id=' . $expiry_days->id) }}" method="post" id="expiry_days_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Days<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off"
                                value="{{ $expiry_days->days }}" name="expiry_days" placeholder="Add expiry_days">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm btn-top-m">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $(document).ready(function() {

            $('#status_form').validate({
                rules: {
                    expiry_days: {
                        required: true,
                    }
                }
            })
        });
    </script>
@endsection
