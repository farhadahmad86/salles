@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Schedule</div>
        <div class="card-body">
            <form action="{{ route('schedule_store') }}" method="post" id="schedule_form">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Date:<span style="color: red">*</span></label>
                            <input type="text" name="date" id="date" autocomplete="off"
                                class="form-control form-control-sm" placeholder="Choose Date..." />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" id="comp_id" name="comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($company as $name)
                                    <option value="{{ $name->id }}">{{ $name->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Type of Visit<span style="color: red">*</span></label>
                            <select name="typeofvisit" id="typeofvisit" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose One</option>
                                @foreach ($visit_type as $type)
                                    <option value="{{ $type->visit_type_id }}">{{ $type->visit_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">Schedule Remarks</label>
                        <textarea name="sch_remarks" class="form-control form-control-sm" cols="30" rows="1"></textarea>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 mb-2">
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
            $('#comp_id').select2();
            $('#typeofvisit').select2();
            $('#schedule_form').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    comp_id: {
                        required: true,
                    },
                    typeofvisit: {
                        required: true,
                    },
                }
            });
            $('#date').datepicker({
                minDate: new Date(),
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
@endsection
