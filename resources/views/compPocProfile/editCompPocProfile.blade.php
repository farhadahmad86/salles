@extends('layouts/app')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">Update POC Profile</div>
        <div class="card-body">
            <form action="{{route('updateCompPocProfile', 'id='.$comp_poc_profile->com_poc_profile_id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <select class="form-control form-control-sm select2" name="poc_comp_id">
                                @foreach($comp_name as $name)
                                    <option value="{{$name->id}}" {{$name->id == $edit_id ? 'selected': ''}}>{{ucfirst($name->company_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">POC Name</label>
                            <input type="text" value="{{$comp_poc_profile->com_poc_profile_name}}" name="poc_name" class="form-control form-control-sm" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" class="form-control form-control-sm" id="" value="{{$comp_poc_profile->com_poc_profile_designation}}" name="poc_designation">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" class="form-control form-control-sm" id="mob" value="{{$comp_poc_profile->com_poc_profile_mobile_no}}" name="poc_mobile">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number</label>
                            <input type="text" class="form-control form-control-sm" id="w_mob" value="{{$comp_poc_profile->com_poc_profile_whatsapp_no}}" name="poc_whatsapp">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-sm" id="" value="{{$comp_poc_profile->com_poc_profile_email}}" name="poc_email">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control form-control-sm" name="poc_status">
                                @foreach($status as $item)
                                    <option value="{{$item->sta_id}}" {{$comp_poc_profile->comprofile_status == $item->sta_id ? 'selected' : ''}}>{{$item->sta_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
