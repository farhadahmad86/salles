@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card ">
        <div class="card-header">Edit Schedule</div>
        <div class="card-body">
            <form action="{{ route('schedule_update') }}" method="post" id="edit_schedule_form">
                @csrf
                <input type="hidden" name="id" value="{{ $schedule->id }}">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Date:<span style="color: red">*</span></label>
                            <input type="text" name="date" id="date" class="form-control form-control-sm"
                                value="{{ $schedule->date }}" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="comp_id">
                                @foreach ($comp_info as $comp_name)
                                    <option
                                        value="{{ $comp_name->id }}"{{ $schedule->company_id == $comp_name->id ? 'selected' : '' }}>
                                        {{ $comp_name->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Type of Visit<span style="color: red">*</span></label>
                            <select name="typeofvisit" class="form-control form-control-sm" id="">
                                @foreach ($visit_type as $type)
                                    <option value="{{ $type->visit_type_id }}"
                                        {{ $schedule->type_of_visit == $type->visit_type_id ? 'selected' : '' }}>
                                        {{ $type->visit_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <label for="">Schedule Remarks</label>
                            <textarea name="sch_remarks" id="" class="form-control form-control-sm" cols="30" rows="1">{{ $schedule->sch_remarks }}</textarea>
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
            $('#edit_schedule_form').validate({
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
