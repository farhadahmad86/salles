@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="{{route('updateRole', 'id='.$user->id)}}" method="post" id="" enctype="multipart/form-data">
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
                            <input type="text" class="form-control form-control-sm" value="{{$user->username}}" name="username" autocomplete="off" id="username">
                            <span id="user_msg"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="email" class="form-control form-control-sm" value="{{$user->email}}" name="email" autocomplete="off" id="email">
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
                            <input type="password" class="form-control form-control-sm" value="" name="password">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" required name="confirm-password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""><b>Address</b></label>
                            <textarea name="adrs" cols="30" rows="1" class="form-control form-control-sm">{{$user->address}}</textarea>
                        </div>
                    </div>
{{--                    <div class="col-md-2">--}}
{{--                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')--}}
{{--                            <div class="form-group">--}}
{{--                                <label for=""><b>Role</b></label>--}}
{{--                                <select name="role" class="form-control form-control-sm" id="role">--}}
{{--                                    @if($user->role == 'Supervisor' || $user->role == 'Admin')--}}
{{--                                        <option value="Supervisor">Supervisor</option>--}}
{{--                                        <option value="Sale Person">Sale Person</option>--}}
{{--                                    @else--}}
{{--                                        <option value="Sale Person">Sale Person</option>--}}
{{--                                        <option value="Supervisor">Supervisor</option>--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group" id="showSuperV" style="display: none">--}}
{{--                                <label for=""><b>Supervisor</b></label>--}}
{{--                                <select name="supervisor" class="form-control form-control-sm">--}}
{{--                                    @foreach($userSupervisors as $userSupervisor)--}}
{{--                                        <option value="{{$userSupervisor->id}}">{{$userSupervisor->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""><b>Image</b></label><br>
                            <div style="display: flex">
                                <img src="storage/img/{{$user->image}}" width="7%" style="margin-right: 5px" alt="">
                                <input type="file" name="img">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm btn-top-m" style="margin-top: 31px">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
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
    </script>
@endsection
