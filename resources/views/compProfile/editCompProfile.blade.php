@extends('layouts/app')
@section('styles')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Update Company Profile</div>
        <div class="card-body">
            <form action="{{ route('updateCompProfile', 'id=' . $compPro->comprofile_id) }}" method="post"
                id="company_profile_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Name<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="comp_id">
                                @foreach ($comp_name as $name)
                                    <option value="{{ $name->id }}" {{ $name->id == $edit_id ? 'selected' : '' }}>
                                        {{ ucfirst($name->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Web Address<span style="color: red">*</span></label>
                            <input type="text" name="web_address" id="poc_web_address"
                                value="{{ $compPro->comprofile_web_address }}" class="form-control form-control-sm"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="mob"
                                value="{{ $compPro->comprofile_mobile_no }}" name="mobile">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="w_mob"
                                value="{{ $compPro->comprofile_whatsapp_no }}" name="whatsapp">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm" id=""
                                value="{{ $compPro->comprofile_email }}" name="email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Ptcl No<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id=""
                                value="{{ $compPro->comprofile_ptcl }}" name="ptcl">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Address<span style="color: red">*</span></label>
                            <textarea name="address" id="" cols="30" rows="1" class="form-control form-control-sm">{{ $compPro->comprofile_address }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="status">
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}"
                                        {{ $compPro->comprofile_status == $item->sta_id ? 'selected' : '' }}>
                                        {{ $item->sta_status }}</option>
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
    <script>
        // Farhad
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('storeTown') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#company_profile_form').validate({
                rules: {
                    comp_id: {
                        required: true,
                    },
                    web_address: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                        digits: true,
                    },
                    whatsapp: {
                        digits: true,
                    },
                    email: {
                        required: true,
                    },

                    ptcl: {
                        required: true,
                        digits: true,
                        minlength: 10,
                    },

                    address: {
                        required: true,
                    },

                    status: {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
