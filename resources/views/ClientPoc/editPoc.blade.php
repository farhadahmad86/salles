@extends('layouts/app')
@section('styles')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Update POC Profile</div>
        <div class="card-body">
            <form action="{{ route('updateClientPoc', 'id=' . $comp_poc_profile->com_poc_profile_id) }}" method="post"
                id="poc_profile_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Name<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" id="poc_comp" name="poc_comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($comp_name as $name)
                                    <option value="{{ $name->id }}"
                                        {{ $name->id == $comp_poc_profile->com_poc_profile_company_id ? 'selected' : '' }}>
                                        {{ ucfirst($name->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">POC Name<span style="color: red">*</span></label>
                            <input type="text" name="poc_name" id="poc_name" class="form-control form-control-sm"
                                autocomplete="off" value="{{ $comp_poc_profile->com_poc_profile_name }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="poc_mob" name="poc_mobile"
                                data-inputmask="'mask': '9999-9999999'"
                                value="{{ $comp_poc_profile->com_poc_profile_mobile_no }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="poc_w_mob" name="poc_whatsapp"
                                data-inputmask="'mask': '9999-9999999'"
                                value="{{ $comp_poc_profile->com_poc_profile_whatsapp_no }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm" id="poc_email" name="poc_email"
                                value="{{ $comp_poc_profile->com_poc_profile_email }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Designation<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" id="poc_designation"
                                name="poc_designation">
                                <option value="" disabled hidden selected>Choose...</option>
                                @foreach ($designation as $designation)
                                    <option value="{{ $designation->designation_id }}"
                                        {{ $designation->designation_id == $comp_poc_profile->com_poc_profile_designation ? 'selected' : '' }}>
                                        {{ ucfirst($designation->designation_title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control form-control-sm" id="poc_status" name="poc_status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}">{{ $item->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
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
        $('document').ready(function() {
            $('#poc_comp').select2();
            $('#poc_designation').select2();

            $('#poc_profile_form').validate({
                rules: {
                    poc_comp_id: {
                        required: true,
                    },
                    poc_name: {
                        // letterandspace: true,
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                    poc_mobile: {
                        required: true,
                        digits: true,
                    },
                    poc_whatsapp: {
                        digits: true,
                    },
                    poc_email: {
                        required: true,
                    },
                    poc_designation: {
                        required: true,
                    },
                    // poc_status: {
                    //     required: true,
                    // },

                }
            });
        });
        $('#poc_mob').keyup(function() {
            $('#poc_w_mob').val($(this).val());
        });
    </script>
@endsection
