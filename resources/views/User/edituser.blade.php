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
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="{{ route('updateuser', 'id=' . $user->id) }}" method="post" enctype="multipart/form-data"
                id="edit_user">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm form-control-sm"
                                value="{{ $user->name }}" name="name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Username<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ $user->username }}"
                                name="username" autocomplete="off" id="username">
                            <span id="user_msg"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm" value="{{ $user->email }}"
                                name="email" autocomplete="off" id="email">
                            <span id="email_msg"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ $user->mob }}"
                                name="mobile">
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Password<span style="color: red">*</span></label>
                            <input type="password" class="form-control form-control-sm" value="" name="password"
                                id="password">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Confirm Password<span style="color: red">*</span></label>
                            <input type="password" class="form-control form-control-sm" name="confirm_password">
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Father Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="f_name"
                                value="{{ $user->f_name }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">CNIC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="cnic"
                                value="{{ $user->cnic }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">DOJ<span style="color: red">*</span></label>
                            <input type="text" id="doj" class="form-control form-control-sm" name="doj"
                                value="{{ $user->doj }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Emergency Contact<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="emergency_contact"
                                value="{{ $user->emergency_contact }}">
                        </div>
                    </div>
                    {{-- @if ($auth == 'Admin') --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Line Manager<span style="color: red">*</span></label>
                            <select name="line_manager" id="line_manager" class="form-control form-control-sm">
                                <option selected hidden disabled>Choose Line Manager</option>
                                @foreach ($get_all_users as $users)
                                    <option value="{{ $users->id }}"{{ $user->id == $users->id ? 'selected' : '' }}>
                                        {{ $users->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- @endif --}}
                    @if ($auth->role != 'Admin' || ($auth->role == 'Admin' && $auth->id != $user->id))
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Role<span style="color: red">*</span></label>
                                <select name="role" class="form-control form-control-sm" id="role">
                                    <option selected hidden disabled>Choose Role</option>
                                    @if ($auth->type == 'Master')
                                        <option value="Admin"{{ 'Admin' == $user->role ? 'selected' : '' }}>Admin</option>
                                    @endif
                                    <option value="Tele Caller"{{ 'Tele Caller' == $user->role ? 'selected' : '' }}>
                                        Tele Caller
                                    </option>
                                    <option value="Supervisor"{{ 'Supervisor' == $user->role ? 'selected' : '' }}>
                                        Supervisor
                                    </option>
                                    <option value="Sale Person"{{ 'Sale Person' == $user->role ? 'selected' : '' }}>Sale
                                        Person
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-2" id="groupDiv" style="display: none;">
                        <div class="form-group">
                            <label for="" style="display: block">Groups<span style="color: red">*</span></label>
                            <select name="groups[]" class="form-control form-control-sm" id="groups" multiple>
                                {{-- <option hidden disabled>Choose Groups</option> --}}
                                @foreach ($groups as $group)
                                    @php
                                        $groups = explode(',', $user->group_id);
                                    @endphp
                                    <option value="{{ $group->groups_id }}"
                                        {{ in_array($group->groups_id, $groups) ? 'selected' : '' }}>
                                        {{ $group->groups_name }}</option>
                                @endforeach
                                {{-- @foreach ($groups as $group)
                                    <option value="{{ $group->groups_id }}">{{ $group->groups_name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Modular Group<span style="color: red">*</span></label>
                            <select name="modular_group" class="form-control form-control-sm" id="modular_group">
                                <option selected hidden disabled>Choose Module</option>
                                @foreach ($modular_groups as $module)
                                    <option
                                        value="{{ $module->name }}"{{ $module->name == $user->modular_group ? 'selected' : '' }}>
                                        {{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Address<span style="color: red">*</span></label>
                            <textarea name="adrs" cols="30" rows="1" class="form-control form-control-sm">{{ $user->address }}</textarea>
                        </div>
                    </div>
                    {{--                    <div class="col-md-2"> --}}
                    {{--                        @if (\Illuminate\Support\Facades\Auth::user()->role == 'Admin') --}}
                    {{--                            <div class="form-group"> --}}
                    {{--                                <label for="">Role</label> --}}
                    {{--                                <select name="role" class="form-control form-control-sm" id="role"> --}}
                    {{--                                    @if ($user->role == 'Supervisor' || $user->role == 'Admin') --}}
                    {{--                                        <option value="Supervisor">Supervisor</option> --}}
                    {{--                                        <option value="Sale Person">Sale Person</option> --}}
                    {{--                                    @else --}}
                    {{--                                        <option value="Sale Person">Sale Person</option> --}}
                    {{--                                        <option value="Supervisor">Supervisor</option> --}}
                    {{--                                    @endif --}}
                    {{--                                </select> --}}
                    {{--                            </div> --}}
                    {{--                            <div class="form-group" id="showSuperV" style="display: none"> --}}
                    {{--                                <label for="">Supervisor</label> --}}
                    {{--                                <select name="supervisor" class="form-control form-control-sm"> --}}
                    {{--                                    @foreach ($userSupervisors as $userSupervisor) --}}
                    {{--                                        <option value="{{$userSupervisor->id}}">{{$userSupervisor->name}}</option> --}}
                    {{--                                    @endforeach --}}
                    {{--                                </select> --}}
                    {{--                            </div> --}}
                    {{--                        @endif --}}
                    {{--                    </div> --}}
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Image<span style="color: red">*</span></label><br>
                            <div style="display: flex">
                                <img src="storage/img/{{ $user->image }}" width="7%" style="margin-right: 5px"
                                    alt="">
                                <input type="file" name="img">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <figure class="image-container">
                                <img src="storage/img/{{ $user->image }}" id="chosen-image">
                            </figure>

                            <input type="file" id="upload-button" name="img" accept="image/*"
                                class="form-control">
                            <label for="upload-button" id="upload">
                                <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                            </label>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Image<span style="color: red">*</span></label><br>
                            <div style="display: flex">
                                <img src="storage/img/{{ $user->image }}" width="7%" style="margin-right: 5px"
                                    alt="">
                                <input type="file" name="img">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm btn-top-m"
                                style="margin-top: 31px">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        // farhad
        $('document').ready(function() {
            $('#line_manager').select2();
            $('#role').select2();
            $('#modular_group').select2();
            $('#groups').select2();
            $('#edit_user').validate({
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
                    'groups[]': {
                        required: function(element) {
                            return $('#role').val() === 'Tele Caller';
                        }
                    },
                    modular_group: {
                        required: true,
                    },
                    img: {
                        required: true,
                        extension: "jpeg|png|jpg"
                    },
                }
            });
            $('#doj').datepicker({
                minDate: new Date(),
                dateFormat: 'dd-mm-yy'
            });
            // Function to show or hide group div and auto-select group IDs based on role
            function toggleGroupDiv(role) {
                if (role === 'Tele Caller') {
                    $('#groupDiv').show();
                    $('#groups').attr('required', true);
                    // Auto-select group IDs
                    $('#groups option').prop('selected', true);
                } else {
                    $('#groupDiv').hide();
                    $('#groups').removeAttr('required');
                }
            }

            // Initial toggle based on the selected role
            toggleGroupDiv($('#role').val());

            // Event handler for role dropdown change
            $('#role').change(function() {
                var role = $(this).val();
                toggleGroupDiv(role);
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
        });
    </script>
@endsection
