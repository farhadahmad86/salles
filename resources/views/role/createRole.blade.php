@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">Create User</div>
        <div class="card-body">
            <form action="{{route('storeRole')}}" method="post" id="user_role_form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control form-control-sm" required name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control form-control-sm" required name="username" autocomplete="off" id="username" value="{{old('username')}}">
                            {{--                    <span id="user_msg"></span>--}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-sm" required name="email" id="email" autocomplete="off" value="{{old('email')}}">
                            {{--                    <span id="email_msg"></span>--}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" class="form-control form-control-sm" required name="mobile" value="{{old('mobile')}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control form-control-sm" required name="password" value="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" required name="confirm-password" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea required name="adrs" cols="30" rows="1" class="form-control form-control-sm">{{old('adrs')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="img" value="{{old('img')}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm btn-top-m" style="margin-top: 31px">Submit</button>
                        </div>
                    </div>
                </div>
{{--                @if(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')--}}
{{--                <div class="form-group">--}}
{{--                    <label for="">Role</label>--}}
{{--                    <select required name="role" class="form-control form-control-sm" id="role">--}}
{{--                        <option value="0" selected hidden disabled>Choose Role</option>--}}
{{--                        <option value="Supervisor">Supervisor</option>--}}
{{--                        <option value="Sale Person">Sale Person</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="form-group" id="showSuperV" style="display: none">--}}
{{--                    <label for="">Supervisor</label>--}}
{{--                    <select name="supervisor" class="form-control form-control-sm">--}}
{{--                        @foreach($roles as $role)--}}
{{--                            <option value="{{$role->id}}">{{$role->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                @endif--}}
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function () {
            // $('#user_role_form').validate({
            //     rules: {
            //         name: {
            //             required: true,
            //         },
            //         mobile: {
            //             // required: true,
            //             digits: true
            //         },
            //         target: {
            //             required: true,
            //             number: true,
            //         },
            //         img: {
            //             // required: true,
            //             extension: "jpeg|png|jpg"
            //         },
            //     },
            //     messages: {
            //         target: {
            //             number: 'Only Numbers Allowed',
            //         }
            //     }
            // });

            //when user click on role
            if(($('#role option:selected').val()) == 'Sale Person'){
                $('#showSuperV').css('display', 'block');
            }
            $('#role').change(function () {
                $optionValue = $(this).children('option:selected').val();
                if ($optionValue == 'Sale Person'){
                    $('#showSuperV').css('display', 'block');
                }
                if ($optionValue == 'Supervisor'){
                    $('#showSuperV').css('display', 'none');
                }
            });

            //email validation
            // $('#email').keyup(function () {
            //     var email = $('#email').val();
            //     var _token = $('input[name="_token"]').val();
            //     var filter = /^[a-zA-Z0-9]+$/;
            //     // if (!filter.test(email)) {
            //     //     $('#email_msg').html('Invalid Email');
            //     //     $('#email_msg').css('color', 'red');
            //     // }
            //     jQuery.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //
            //     $.ajax({
            //         url: "/checkEmail",
            //         type: "GET",
            //         data: {
            //             'email': email
            //         },
            //         cache: false,
            //         success: function (result) {
            //             if (result == 'unique') {
            //                 $('#email_msg').html('Email Available');
            //                 $('#email_msg').css('color', 'green');
            //             } else{
            //                 $('#email_msg').html('Email already Exist');
            //                 $('#email_msg').css('color', 'red');
            //             }
            //         }
            //     });
            // });

            //username validation
            // $('#username').keyup(function () {
            //
            //     var username = $('#username').val();
            //     var _token = $('input[name="_token"]').val();
            //     var filter = /^[a-zA-Z0-9]+$/;
            //     if (!filter.test(username) && username != '') {
            //         $('#user_msg').html('Invalid Username');
            //         $('#user_msg').css('color', 'red');
            //     } else {
            //         jQuery.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            //             }
            //         });
            //
            //         $.ajax({
            //             url: "/checkUser",
            //             type: "GET",
            //             data: {
            //                 'username': username
            //             },
            //             cache: false,
            //             success: function (result) {
            //                 if (result == 'unique') {
            //                     $('#user_msg').html('Username Available');
            //                     $('#user_msg').css('color', 'green');
            //                 } else{
            //                     $('#user_msg').html('Username already Exist');
            //                     $('#user_msg').css('color', 'red');
            //                 }
            //             }
            //         });
            //     }
            // });
        })
    </script>
@endsection
