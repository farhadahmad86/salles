@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8  mt-4">
                <div class="card">
                    <div class="card-header">Change Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('change_password') }}" id="change_password">
                            @csrf

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password"
                                        autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                        autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control"
                                        name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $('document').ready(function() {
            $('#change_password').validate({
                rules: {
                    current_password: {
                        required: true,
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                    },
                    new_confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#new_password",
                    },
                },
                messages: {
                    new_confirm_password: {
                        equalTo: 'Please enter the same password',
                    }
                }
            });
        })
    </script>
@endsection
