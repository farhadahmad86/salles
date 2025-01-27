@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Schedule</div>
        <div class="card-body">
            <form action="{{ route('store_company') }}" method="post" id="schedule_form">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label col-form-label-sm" for="company_name">Company
                                    Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="company_name"
                                    name="company_name" placeholder="Enter a company Name..">
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label col-form-label-sm" for="number">Company
                                    Contact<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="number" name="number"
                                    placeholder="Enter a Number.." onkeypress="return numberFormatter(event)">
                            </div>
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
