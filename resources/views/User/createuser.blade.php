@extends('layouts/app')
@section('styles')
    <style>
        .image-container {
            width: 35%;
            margin: 0 auto 30px auto;
        }

        .image-container img {
            display: block;
            position: relative;
            max-width: 100%;
            max-height: 400px;
            margin: auto;
        }

        figcaption {
            /* margin: 20px 0 30px 0; */
            text-align: center;
            color: #2a292a;
        }

        input[type="file"] {
            display: none;
        }

        #upload {
            display: block;
            position: relative;
            background-color: #025bee;
            color: #ffffff;
            font-size: 12px;
            text-align: center;
            width: 150px;
            padding: 10px 0;
            border-radius: 5px;
            margin: auto;
            cursor: pointer;
        }

        .select2.select2-container {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Create User</div>
        <div class="card-body">
            <form action="{{ route('storeuser') }}" method="post" id="create_user" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Username<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="username" autocomplete="off"
                                id="username" value="{{ old('username') }}">
                            {{-- <span id="user_msg"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email"
                                autocomplete="off" value="{{ old('email') }}">
                            {{-- <span id="email_msg"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="mobile"
                                value="{{ old('mobile') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="password">Password<span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-sm" name="password" id="password"
                                    value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="togglePassword"></i>
                                    </span>
                                </div>
                            </div>
                            <label id="password-error" class="error" for="password"></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password<span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-sm" name="confirm_password"
                                    id="confirm_password" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                    </span>
                                </div>
                            </div>
                            <label id="confirm_password-error" class="error" for="confirm_password"></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Father Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="f_name"
                                value="{{ old('f_name') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">CNIC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="cnic"
                                value="{{ old('cnic') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">DOJ<span style="color: red">*</span></label>
                            <input type="text" id="doj" class="form-control form-control-sm" name="doj"
                                value="{{ old('doj') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Emergency Contact<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="emergency_contact"
                                value="{{ old('emergency_contact') }}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Line Manager<span style="color: red">*</span></label>
                            <select name="line_manager" id="line_manager" class="form-control form-control-sm">
                                <option selected hidden disabled>Choose Line Manager</option>
                                @foreach ($get_all_users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Role<span style="color: red">*</span></label>
                            <select name="role" class="form-control form-control-sm" id="role">
                                <option selected hidden disabled>Choose Role</option>
                                @if ($auth->type == 'Master')
                                    <option value="Admin">Admin</option>
                                @endif
                                <option value="Tele Caller">Tele Caller</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Sale Person">Sale Person</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" id="groupDiv" style="display: none;">
                        <div class="form-group">
                            <label for="" style="display: block">Groups<span style="color: red">*</span></label>
                            <select name="groups[]" class="form-control form-control-sm" id="groups" multiple>
                                <option hidden disabled>Choose Groups</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->groups_id }}">{{ $group->groups_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Modular Group<span style="color: red">*</span></label>
                            <select name="modular_group" class="form-control form-control-sm" id="modular_group">
                                <option selected hidden disabled>Choose Module</option>
                                @foreach ($modular_groups as $module)
                                    <option value="{{ $module->name }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Address<span style="color: red">*</span></label>
                            <textarea name="adrs" cols="30" rows="3" class="form-control form-control-sm">{{ old('adrs') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <figure class="image-container">
                                <img id="chosen-image">
                            </figure>

                            <input type="file" id="upload-button" name="img" accept="image/*"
                                class="form-control">
                            <label for="upload-button" id="upload">
                                <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 35px">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </div>
                {{-- @if (\Illuminate\Support\Facades\Auth::user()->role == 'Admin') --}}
                {{-- <div class="form-group"> --}}
                {{-- <label for="">Role</label> --}}
                {{-- <select required name="role" class="form-control form-control-sm" id="role"> --}}
                {{-- <option value="0" selected hidden disabled>Choose Role</option> --}}
                {{-- <option value="Supervisor">Supervisor</option> --}}
                {{-- <option value="Sale Person">Sale Person</option> --}}
                {{-- </select> --}}
                {{-- </div> --}}
                {{-- <div class="form-group" id="showSuperV" style="display: none"> --}}
                {{-- <label for="">Supervisor</label> --}}
                {{-- <select name="supervisor" class="form-control form-control-sm"> --}}
                {{-- @foreach ($roles as $role) --}}
                {{-- <option value="{{$role->id}}">{{$role->name}}</option> --}}
                {{-- @endforeach --}}
                {{-- </select> --}}
                {{-- </div>
                    --}}
                {{-- @endif --}}
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        // farhad
        let uploadButton = document.getElementById("upload-button");
        let chosenImage = document.getElementById("chosen-image");
        // let fileName = document.getElementById("file-name");

        uploadButton.onchange = () => {
            let reader = new FileReader();
            reader.readAsDataURL(uploadButton.files[0]);
            reader.onload = () => {
                chosenImage.setAttribute("src", reader.result);
            }
            fileName.textContent = uploadButton.files[0].name;
        }
        $('document').ready(function() {
            $('#role').change(function() {
                var role = $(this).val();
                if (role === 'Tele Caller') {
                    $('#groupDiv').show();
                    $('#groups').attr('required', true);
                } else {
                    $('#groupDiv').hide();
                    $('#groups').removeAttr('required');
                }
            });
            $('#line_manager').select2();
            $('#groups').select2();
            $('#role').select2();
            $('#modular_group').select2();
            $('#create_user').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    mobile: {
                        required: true,
                        digits: true,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password",
                    },
                    adrs: {
                        required: true,
                    },
                    f_name: {
                        required: true,
                    },
                    cnic: {
                        required: true,
                    },
                    doj: {
                        required: true,
                    },
                    emergency_contact: {
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
                    img: {
                        required: true,
                        extension: "jpeg|png|jpg"
                    },
                    'groups[]': {
                        required: function(element) {
                            return $('#role').val() === 'Tele Caller';
                        }
                    }
                },
                messages: {
                    target: {
                        number: 'Only Numbers Allowed',
                    }
                }
            });
            $('#doj').datepicker({
                minDate: new Date(),
                dateFormat: 'dd-mm-yy'
            });
            //when user click on role
            if (($('#role option:selected').val()) == 'Sale Person') {
                $('#showSuperV').css('display', 'block');
            }
            $('#role').change(function() {
                $optionValue = $(this).children('option:selected').val();
                if ($optionValue == 'Sale Person') {
                    $('#showSuperV').css('display', 'block');
                }
                if ($optionValue == 'Supervisor') {
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
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var icon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            var confirmPasswordInput = document.getElementById('confirm_password');
            var icon = document.getElementById('toggleConfirmPassword');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endsection
