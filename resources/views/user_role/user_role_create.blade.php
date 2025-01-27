@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create User Role</div>
        <div class="card-body">
            <form action="{{ route('user_role_store') }}" method="post" id="user_role_form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Name<span style="color: red">*</span></label>
                            <select name="user_id" id="name" class="form-control form-control-sm">
                                <option value="0" selected hidden disabled>Choose Name</option>
                                @foreach ($names as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Line Manager<span style="color: red">*</span></label>
                            <select name="line_manager" id="line_manager" class="form-control form-control-sm">
                                {{--                                <option selected hidden disabled>Choose Line Manager</option> --}}
                                {{--                                @foreach ($line_managers as $line_manager) --}}
                                {{--                                    <option value="{{$line_manager->id}}">{{$line_manager->name}}</option> --}}
                                {{--                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Role<span style="color: red">*</span></label>
                            <select name="role" class="form-control form-control-sm" id="role">
                                <option selected hidden disabled>Choose Role</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Sale Person">Sale Person</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Modular Group<span style="color: red">*</span></label>
                            <select name="modular_group" class="form-control form-control-sm" id="modular_group">
                                <option selected hidden disabled>Choose Module</option>
                                @foreach ($modular_groups as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 31px">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function() {
            $('#name').change(function() {
                var name = $('#name option:selected').val();
                $.ajax({
                    url: '{{ route('user_role_ajax') }}',
                    method: 'get',
                    datatype: 'text',
                    data: {
                        'name': name,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#line_manager').html(response.selected_LM);
                        $('#role').html(response.selected_role);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });


            $('#user_role_form').validate({
                rules: {
                    user_id: {
                        required: true,
                    },
                    line_manager: {
                        required: true,
                    },
                    role: {
                        required: true,
                    },
                    modular_group: {
                        required: true,
                    },
                },
            });

            //when user click on role
            // if(($('#role option:selected').val()) == 'Sale Person'){
            //     $('#showSuperV').css('display', 'block');
            // }
            // $('#role').change(function () {
            //     $optionValue = $(this).children('option:selected').val();
            //     if ($optionValue == 'Sale Person'){
            //         $('#showSuperV').css('display', 'block');
            //     }
            //     if ($optionValue == 'Supervisor'){
            //         $('#showSuperV').css('display', 'none');
            //     }
            // });

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
