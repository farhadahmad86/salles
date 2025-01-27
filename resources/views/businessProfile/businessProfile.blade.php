@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Update Profile</div>
        <div class="card-body">
            @if ($business_profile == '')
                <b>Note:</b> The Business profile is not updated by Admin.
            @else
                <form action="{{ route('updateBusinessProfile', 'id=' . $business_profile->business_profile_id) }}"
                    method="post" enctype="multipart/form-data" id="business_profile">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Name<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm form-control-sm"
                                    value="{{ $business_profile->business_profile_name }}" name="name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Email<span style="color: red">*</span></label>
                                <input type="email" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_email }}" name="email">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Mobile<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_mobile_no }}" name="mobile_no">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Ptcl No<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_ptcl_no }}" name="ptcl_no">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Ntn No<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_ntn_no }}" name="ntn_no">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Gst No<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_gst_no }}" name="gst_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Web Address<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $business_profile->business_profile_web_address }}" name="web_address">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Address<span style="color: red">*</span></label>
                                <textarea name="address" cols="30" rows="1" class="form-control form-control-sm">{{ $business_profile->business_profile_address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Logo<span style="color: red">*</span></label><br>
                                <div style="display: flex">
                                    <img src="storage/img/{{ $business_profile->business_profile_logo }}" alt=""
                                        style="margin-right: 5px; width: 34px; height: 31px"><br><br>
                                    <input type="file" name="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col mb-2">
                                <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_schedule_target">Submit</button>
                            </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        // farhad
        var base = '{{ route('updateBusinessProfile') }}',
            url;
        @include('print.print_script_sh')
        $('document').ready(function() {
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#business_profile').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                        digits: true,
                    },
                    ptcl_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                    },
                    ntn_no: {
                        required: true,
                        digits: true,
                        minlength: 7,
                    },
                    gst_no: {
                        required: true,
                        digits: true,
                        minlength: 13,
                    },
                    web_address: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    logo: {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
