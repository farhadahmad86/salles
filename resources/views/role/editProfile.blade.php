@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">Update Profile</div>
        <div class="card-body">
            <form action="{{route('updateProfile')}}" method="post" id="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Name</b></label>
                            <input type="text" class="form-control form-control-sm form-control-sm" value="{{$user->name}}" name="name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Username</b></label>
                            <input type="text" class="form-control form-control-sm" value="{{$user->username}}" readonly autocomplete="off">
                            <span id="user_msg"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="email" class="form-control form-control-sm" value="{{$user->email}}" readonly autocomplete="off">
                            <span id="email_msg"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Mobile</b></label>
                            <input type="text" class="form-control form-control-sm" value="{{$user->mob}}" name="mobile">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Password</b></label>
                            <input type="password" class="form-control form-control-sm" value="" name="pass">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Address</b></label>
                            <textarea name="adrs" cols="30" rows="1" class="form-control form-control-sm">{{$user->address}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""><b>Image</b></label><br>
                            <div style="display: flex">
                                <img src="storage/img/{{$user->image}}" style="margin-right: 5px; width: 34px; height: 31px" alt=""><br><br>
                                <input type="file" name="img">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function () {
            $('#user_role_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    mobile: {
                        // required: true,
                        digits: true
                    },
                    target: {
                        required: true,
                        number: true,
                    },
                    img: {
                        // required: true,
                        extension: "jpeg|png|jpg"
                    },
                },
                messages: {
                    target: {
                        number: 'Only Numbers Allowed',
                    }
                }
            });
        })
    </script>
@endsection
