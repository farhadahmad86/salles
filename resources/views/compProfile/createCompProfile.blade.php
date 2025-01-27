@extends('layouts/app')
@section('styles')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Create Company Profile</div>
        <div class="card-body">
            <form action="{{ route('storeCompProfile') }}" method="post" id="company_profile_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Name<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" id="poc_comp" name="comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($comp_name as $name)
                                    <option value="{{ $name->id }}">{{ ucfirst($name->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Web Address<span style="color: red">*</span></label>
                            <input type="text" name="web_address" value="{{ old('web_address') }}" id="poc_web_address"
                                class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ old('mobile') }}"
                                id="poc_mob" name="mobile" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ old('whatsapp') }}"
                                id="poc_w_mob" name="whatsapp" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm" value="{{ old('email') }}"
                                id="poc_email" name="email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Ptcl No<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ old('ptcl') }}"
                                id="ptcl" name="ptcl">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Address<span style="color: red">*</span></label>
                            <textarea name="address" id="" cols="30" rows="1" class="form-control form-control-sm">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" id="poc_status" name="status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}">{{ $item->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <input type="submit" class="btn btn-primary btn-sm btn-top-m" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="card mt-5">
        <div class="card-header">POC Profiles</div>
        <div class="card-body">
            <table class="table" id="company_profile">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>POC Name</th>
                        <th>Designation</th>
                        <th>Mobile</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="profile_table">

                </tbody>
            </table>
            <hr>
            <button type="submit" class="btn btn-primary btn-sm float-right" form="company_profile_form">Submit</button>
        </div>
    </div> --}}
@endsection


@section('javascript')
    <script>
        $('#poc_mob').keyup(function() {
            $('#poc_w_mob').val($(this).val());
        });
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
        // $('document').ready(function () {
        // window.row_count = 0;
        // $('#create_poc').click(function(){
        //     // var comp_id = $('#poc_comp option:selected').val();
        //     var company_name_text = $('#poc_comp option:selected').text();
        //     var poc_name = $('#poc_name').val();
        //     var poc_designation = $('#poc_designation').val();
        //     var poc_mobile = $('#poc_mob').val();
        //     var poc_whatsapp_mob = $('#poc_w_mob').val();
        //     var poc_email = $('#poc_email').val();
        //     var poc_status = $('#poc_status option:selected').val();
        //     if ($('#poc_comp')[0].selectedIndex <= 0){
        //         $('#poc_comp').focus();
        //         return;
        //     }
        //     if(poc_name == ''){
        //         $('#poc_name').focus();
        //         return;
        //     }
        //     if(poc_designation == ''){
        //         $('#poc_designation').focus();
        //         return;
        //     }
        //     if(poc_mobile == ''){
        //         $('#poc_mob').focus();
        //         return;
        //     }
        //     if(poc_whatsapp_mob == ''){
        //         $('#poc_w_mob').focus();
        //         return;
        //     }
        //     if(poc_email == ''){
        //         $('#poc_email').focus();
        //         return;
        //     }else{
        //         var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //         if(!regex.test(poc_email)) {
        //             $('#poc_email').focus();
        //             return false;
        //         }
        //     }
        //     if ($('#poc_status')[0].selectedIndex <= 0){
        //         $('#poc_status').focus();
        //         return;
        //     }
        //     // $('#company_profile_form').append('<input type="text" value="'+company_name+'" name="comp_id[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_name+'" name="name[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_designation+'" name="designation[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_mobile+'" name="mobile[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_email+'" name="email[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_status+'" name="status[]" class="'+row_count+'">');
        //     $('#company_profile_form').append('<input type="hidden" value="'+poc_whatsapp_mob+'" name="whatsapp[]" class="'+row_count+'">');
        //     $('#profile_table').append('<tr><td>'+company_name_text+'</td><td>'+poc_name+'</td><td>'+poc_designation+'</td><td>'+poc_mobile+'</td>' +
        //         '<td>'+poc_whatsapp_mob+'</td><td>'+poc_email+'</td><td>'+poc_status+'</td>' +'<td><button class="btn btn-danger btn-sm" onclick="delete_row(this, '+row_count+')">Delete</button></td></tr>');
        //     row_count++;
        //     $('#poc_name').val('');
        //     $('#poc_designation').val('');
        //     $('#poc_mob').val('');
        //     $('#poc_w_mob').val('');
        //     $('#poc_email').val('');
        //     $('#poc_comp').css('pointer-events','none');
        // });
        // });
        // function delete_row(r, del_row){
        //     $('.'+del_row).remove();
        //     var i = r.parentNode.parentNode.rowIndex;
        //     document.getElementById("company_profile").deleteRow(i);
        //     row_count--;
        //     grand_total();
        // }
    </script>
@endsection
