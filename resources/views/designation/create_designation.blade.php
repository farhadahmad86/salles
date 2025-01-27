@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Designation</div>
        <div class="card-body">
            <form action="{{ route('storedesignation') }}" method="post" id="create_designation">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Title<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="designation_title"
                                value="{{ old('designation_title') }}">
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
    {{-- Farhad --}}
    <script>
        $('document').ready(function() {

            $('#create_designation').validate({
                rules: {
                    designation_title: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                }
            });
        });
    </script>
@endsection
