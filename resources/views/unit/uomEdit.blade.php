@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Unit</div>
        <div class="card-body">
            <form action="{{ route('uomUpdate', 'id=' . $data->unit_id) }}" method="post" id="unit">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Main Unit<span style="color: red">*</span></label>
                            <select name="main_unit" id="" class="form-control form-control-sm">
                                @foreach ($main_unit as $item)
                                    <option value="{{ $item->main_unit_id }}"
                                        {{ $data->unit_main_unit_id == $item->main_unit_id ? 'selected' : '' }}>
                                        {{ $item->main_unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Unit Of Measurement<span style="color: red">*</span></label>
                            <input type="text" name="unit_name" value="{{ $data->unit_name }}"
                                class="form-control form-control-sm">
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Scale Size</label>
                            <input type="text" name="unit_scale_size" value="{{ $data->unit_scale_size }}"
                                class="form-control form-control-sm">
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Unit Remarks</label>
                            <textarea name="unit_remarks" class="form-control form-control-sm" cols="30" rows="1">{{ $data->unit_remarks }}</textarea>
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
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#unit').validate({
                rules: {
                    main_unit: {
                        required: true,
                    },
                    unit_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 30,
                    },
                    unit_remarks: {
                        maxlength: 500,
                    },
                }
            });
        });
    </script>
@endsection
