@extends('layouts/app')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">Create Poc Profile</div>
        <div class="card-body">
            <form action="{{route('storeCompPocProfile')}}" method="post" id="company_poc_profile_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <select class="form-control form-control-sm" id="poc_comp" name="poc_comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach($comp_name as $name)
                                    <option value="{{$name->id}}">{{ucfirst($name->company_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">POC Name</label>
                            <input type="text" name="poc_name" id="poc_name" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" class="form-control form-control-sm" id="poc_mob" name="poc_mobile" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number</label>
                            <input type="text" class="form-control form-control-sm" id="poc_w_mob" name="poc_whatsapp" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-sm" id="poc_email" name="poc_email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" class="form-control form-control-sm" id="poc_designation" name="poc_designation">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control form-control-sm" id="poc_status" name="poc_status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $item)
                                    <option value="{{$item->sta_id}}">{{$item->sta_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-primary btn-sm btn-top-m" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('javascript')
    <script>
        $('#company_poc_profile_form').validate({
            rules: {

            }
        });
        $('#poc_mob').keyup(function () {
            $('#poc_w_mob').val($(this).val());
        });
    </script>
@endsection
