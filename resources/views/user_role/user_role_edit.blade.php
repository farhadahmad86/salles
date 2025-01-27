@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 title">
            <h1 class="text-center">Edit User</h1>
        </div>
    </div>
    <button class="btn btn-primary mt-5" onclick="window.history.back()">Go Back</button>
    <div class="card mt-5" style="width: 50%; margin: 0 auto">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="{{route('updateRole', 'id='.$user->id)}}" method="post" id="" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Name</b></label>
                    <input type="text" class="form-control form-control-sm form-control-sm" value="{{$user->name}}" name="name">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Username</b></label>
                    <input type="text" class="form-control form-control-sm" value="{{$user->username}}" name="username" autocomplete="off" id="username">
                    <span id="user_msg"></span>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Email</b></label>
                    <input type="email" class="form-control form-control-sm" value="{{$user->email}}" name="email" autocomplete="off" id="email">
                    <span id="email_msg"></span>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Mobile</b></label>
                    <input type="text" class="form-control form-control-sm" value="{{$user->mob}}" name="mobile">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Password</b></label>
                    <input type="password" class="form-control form-control-sm" value="" name="password">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm">Confirm Password</label>
                    <input type="password" class="form-control form-control-sm" required name="confirm-password">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Address</b></label>
                    <textarea name="adrs" cols="30" rows="5" class="form-control form-control-sm">{{$user->address}}</textarea>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Role</b></label>
                    <select name="role" class="form-control form-control-sm" id="role">
                        @if($user->role == 'Supervisor' || $user->role == 'Admin')
                            <option value="Supervisor">Supervisor</option>
                            <option value="Sale Person">Sale Person</option>
                        @else
                            <option value="Sale Person">Sale Person</option>
                            <option value="Supervisor">Supervisor</option>
                        @endif
                    </select>
                </div>
                <div class="form-group" id="showSuperV" style="display: none">
                    <label for="" class="col-form-label-sm"><b>Supervisor</b></label>
                    <select name="supervisor" class="form-control form-control-sm">
                        @foreach($userSupervisors as $userSupervisor)
                            <option value="{{$userSupervisor->id}}">{{$userSupervisor->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="" class="col-form-label-sm"><b>Image</b></label><br>
                    <img src="storage/img/{{$user->image}}" width="20%" alt=""><br><br>
                    <input type="file" name="img">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="margin-top: 31px">Submit</button>
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
