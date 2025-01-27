@extends('layouts.app')
@section('styles')
    <style>
        #com_sector-error {
            position: absolute;
            margin-top: 62px;
            margin-left: -40px;
        }
    </style>
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">Add Clients</div>
        <div class="card-body">
            <form action="{{ route('storeClients') }}" method="post" id="company_form">
                @csrf
                <div class="row">
                    {{--                    <div class="col-md-12" >
{{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Region</label><span class="float-right"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#com_add_region"> Add </button></span> --}}
                    {{--                            <select name="com_region_id" id="com_region" class="form-control form-control-sm"> --}}
                    {{--                                <option selected disabled hidden>Choose Region</option> --}}
                    {{--                                @foreach ($regions as $region) --}}
                    {{--                                    <option value="{{$region->region_id}}">{{$region->reg_name}}</option> --}}
                    {{--                                @endforeach --}}
                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-12" > --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Area</label><span class="float-right"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#com_add_area"> Add </button></span> --}}
                    {{--                            <select name="com_area_id" id="com_area" class="form-control form-control-sm"> --}}

                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Sector</label><span class="float-right"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#com_add_sector"> Add </button></span> --}}
                    {{--                            <select name="com_sector_id" id="com_sector" class="form-control form-control-sm"> --}}

                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    <input type="hidden" value="" id="com_region" name="com_region_id">
                    <input type="hidden" value="" id="com_area" name="com_area_id">
                    <input type="hidden" value="" id="com_sector" name="com_sector_id">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Town<span style="color: red">*</span></label>
                            <select name="com_town_id" id="com_town" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Town</option>
                                @foreach ($get_town as $town)
                                    <option value="{{ $town->town_id }}" data-region="{{ $town->town_region_id }}"
                                        data-area="{{ $town->town_area_id }}" data-sector="{{ $town->town_sector_id }}">
                                        {{ $town->town_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Business Category<span style="color: red">*</span></label>
                            <select name="business_category" id="business_category" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose...</option>
                                @foreach ($business_category as $category)
                                    <option value="{{ $category->business_category_id }}">
                                        {{ $category->business_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Client Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" id="company"
                                aria-describedby="emailHelp" name="comp_name" placeholder="Add Client">
                            {{--                            <span id="message"></span> --}}
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
                                id="client_mob" name="mobile" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" value="{{ old('whatsapp') }}"
                                id="client_w_mob" name="whatsapp" data-inputmask="'mask': '9999-9999999'">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Map Coordinates<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('map_coordinate') }}" id="map_coordinate" name="map_coordinate">
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" id="poc_status" name="status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}">{{ $item->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Clients Remarks</label>
                            <textarea name="comp_remarks" id="" cols="30" rows="1" class="form-control form-control-sm"
                                placeholder="Add Remarks"></textarea>
                            {{--                            <span id="message"></span> --}}
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" id="add_comp" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{--    Company Modal --}}

    {{-- Add Region Modal --}}

    {{--   <div class="modal fade" id="com_add_region" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <input type="text" class="form-control form-control-sm" autocomplete="off"
                                        id="com_mod_region" name="mod_region">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Remarks</label>
                                    <textarea name="mod_reg_remarks" id="com_mod_reg_remarks" class="form-control form-control-sm" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-dismiss="modal" id="com_add_reg_submit"
                            class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    Add Area Modal
    <div class="modal fade" id="com_add_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="mod_region" id="com_mod_region_2" class="form-control form-control-sm">
                                        <option selected disabled hidden>Choose Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->region_id }}">{{ $region->reg_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Area</label>
                                    <input type="text" class="form-control form-control-sm" autocomplete="off"
                                        id="com_mod_area" name="mod_area">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Remarks</label>
                                    <textarea name="mod_area_remarks" id="com_mod_area_remarks" class="form-control form-control-sm" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-dismiss="modal" id="com_insert_area_submit"
                            class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    Add Sector Modal
    <div class="modal fade" id="com_add_sector" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Sector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="mod_region" id="com_mod_region_3" class="form-control form-control-sm">
                                        <option selected disabled hidden>Choose Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->region_id }}">{{ $region->reg_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Area</label>
                                    <select name="mod_region" id="com_mod_area_2" class="form-control form-control-sm">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Sector</label>
                                    <input type="text" class="form-control form-control-sm" autocomplete="off"
                                        id="com_mod_sector" name="mod_area">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Remarks</label>
                                    <textarea name="mod_sec_remarks" id="com_mod_sec_remarks" class="form-control form-control-sm" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-dismiss="modal" id="com_insert_sec_submit"
                            class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


@section('javascript')
    <script>
        $('document').ready(function() {
        $('#com_town').select2();
        $('#business_category').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#company_form').validate({
                rules: {
                    com_town_id: {
                        required: true,
                    },
                    business_category: {
                        required: true,
                    },
                    comp_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                    },
                    web_address: {
                        required: true,
                        // url: true,
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 13,
                    },
                    whatsapp: {
                        digits: true,
                    },
                    email: {
                        required: true,
                        email: true
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
                    map_coordinate: {
                        minlength: 15,
                        required: true,
                    },
                }
            });
        });

        $('#com_town').change(function() {
            $('#com_region').val($('#com_town option:selected').data('region'));
            $('#com_area').val($('#com_town option:selected').data('area'));
            $('#com_sector').val($('#com_town option:selected').data('sector'));
        })
        $('#client_mob').keyup(function() {
            $('#client_w_mob').val($(this).val());
        });
        //get area when click on region
        // $('#com_region').change(function () {
        //     var region = $(this).children('option:selected').val();
        //     $.ajax({
        //         url: '/com_get_area',
        //         method: 'GET',
        //         datatype: 'text',
        //         data: {
        //             'region': region,
        //         },
        //         success: function (response) {
        //             $('#com_area').html(response);
        //         }
        //     })
        // });
        //get sector when click on area
        // $('#com_area').change(function () {
        //     var area = $(this).children('option:selected').val();
        //     var region = $('#com_region option:selected').val();
        //     $.ajax({
        //         url: '/com_get_sec',
        //         method: 'GET',
        //         datatype: 'text',
        //         data: {
        //             'region': region,
        //             'area': area,
        //         },
        //         success: function (response) {
        //             $('#com_sector').html(response);
        //         }
        //     })
        // });
        // Add Region on Company page
        // $('#com_add_reg_submit').click(function () {
        //     var region = $('#com_mod_region').val();
        //     var region_remarks = $('#com_mod_reg_remarks').val();
        //     $.ajax({
        //         url: 'insert_region',
        //         method: 'get',
        //         datatype: 'text',
        //         data: {
        //             'region': region,
        //             'region_remarks': region_remarks,
        //         },
        //         success: function (response) {
        //             $('#com_region').html(response);
        //         }
        //     })
        // });
        // Add Area on Company page
        // $('#com_insert_area_submit').click(function () {
        //     var region = $('#com_mod_region_2').children('option:selected').val();
        //     var area = $('#com_mod_area').val();
        //     var area_remarks = $('#com_mod_area_remarks').val();
        //     // $('#sec_mod_area').val('');
        //     // $('#sec_mod_area_remarks').val('');
        //     $.ajax({
        //         url: 'insert_area',
        //         method: 'get',
        //         datatype: 'text',
        //         data: {
        //             'region': region,
        //             'area': area,
        //             'area_remarks': area_remarks,
        //         },
        //         success: function (response) {
        //             $('#com_area').html(response);
        //         }
        //     })
        // });
        // Add Sector on Company page
        // $('#com_insert_sec_submit').click(function () {
        //     var region = $('#com_mod_region_3').children('option:selected').val();
        //     var area = $('#com_mod_area_2 option:selected').val();
        //     var sector = $('#com_mod_sector').val();
        //     var sector_remarks = $('#com_mod_sec_remarks').val();
        //     // alert(region+','+area+','+sector+','+sector_remarks);
        //     $.ajax({
        //         url: '/insert_sector',
        //         method: 'get',
        //         datatype: 'text',
        //         data: {
        //             'region': region,
        //             'area': area,
        //             'sector': sector,
        //             'sector_remarks': sector_remarks,
        //         },
        //         success: function (response) {
        //             $('#com_sector').html(response);
        //         }
        //     })
        // });
        //Company (show area after click on region)
        // $('#com_mod_region_3').change(function () {
        //     var value = $(this).children('option:selected').val();
        //     $.ajax({
        //         url: '/get_area',
        //         method: 'GET',
        //         datatype: 'text',
        //         data: {
        //             'value': value
        //         },
        //         success: function (response) {
        //             $('#com_mod_area_2').html(response);
        //         }
        //     })
        // });

        // $('#company').blur(function () {
        //     var company = $('#company').val();
        //     var _token = $('input[name="_token"]').val();
        //     var filter = /^[a-zA-Z0-9]+$/;
        //     if (!filter.test(company)) {
        //         $('#message').html('Invalid Company Name');
        //         $('#message').css('color', 'red');
        //     } else {
        //         jQuery.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //
        //         $.ajax({
        //             url: "/checkCompName",
        //             type: "POST",
        //             data: {
        //                 company: company
        //             },
        //             cache: false,
        //             success: function (result) {
        //                 if (result == 'unique') {
        //                     $('#message').html('Company Name Available');
        //                     $('#message').css('color', 'green');
        //                 } else{
        //                     $('#message').html('Company name already Exist');
        //                     $('#message').css('color', 'red');
        //                 }
        //             }
        //         });
        //     }
        // });
    </script>
@endsection
