@extends('layouts/app')
@section('styles')
    <style>
        #category-error {
            position: fixed;
            margin-top: 62px;
            margin-left: -64px;
        }
    </style>
@endsection
@section('content')
    <div class="card ">
        <div class="card-header">Create Group</div>
        <div class="card-body">
            <form action="{{ route('storeGroup') }}" method="post" id="Group_form">
                @csrf
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Group Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="group_name" name="group_name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Users<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" multiple="multiple" name="users[]"
                                data-placeholder="Choose users" id="users">
                                @foreach ($get_users as $users)
                                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('#date').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('document').ready(function() {
            $('#users').select2();
            $('#Group_form').validate({
                ignore: [],
                rules: {
                    group_name: {
                        required: true,
                    },
                    'users[]': {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
