@extends('layouts.app')
@section('styles')
    <style>
        #com_sector-error {
            position: fixed;
            margin-top: 62px;
            margin-left: -40px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Edit Client</div>
        <div class="card-body">
            <form action="{{ route('updateClients', 'id=' . $edit_company->id) }}" method="post" id="edit_company_form">
                @csrf
                <div class="row">
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Region</label> --}}
                    {{--                            <select name="com_region_id" id="com_region" class="form-control form-control-sm"> --}}
                    {{--                                <option selected disabled hidden>Choose Region</option> --}}
                    {{--                                @foreach ($get_region as $region) --}}
                    {{--                                    <option value="{{$region->region_id}}" {{$region->region_id == $edit_company->com_region_id ? 'selected' : ''}}>{{$region->reg_name}}</option> --}}
                    {{--                                @endforeach --}}
                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Area</label> --}}
                    {{--                            <select name="com_area_id" id="com_area" class="form-control form-control-sm"> --}}
                    {{--                                <option selected disabled hidden>Choose Region</option> --}}
                    {{--                                @foreach ($get_area as $area) --}}
                    {{--                                    <option value="{{$area->area_id}}" {{$area->area_id == $edit_company->com_area_id ? 'selected' : ''}}>{{$area->area_name}}</option> --}}
                    {{--                                @endforeach --}}
                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{--                    <div class="col-md-12"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">Sector</label> --}}
                    {{--                            <select name="com_sector_id" id="com_sector" class="form-control form-control-sm"> --}}
                    {{--                                <option selected disabled hidden>Choose Region</option> --}}
                    {{--                                @foreach ($get_sector as $sector) --}}
                    {{--                                    <option value="{{$sector->sector_id}}" {{$sector->sector_id == $edit_company->com_sector_id ? 'selected' : ''}}>{{$sector->sec_name}}</option> --}}
                    {{--                                @endforeach --}}
                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{-- <input type="hidden" id="com_region" name="com_region_id" value="{{ $edit_company->com_region_id }}">
                    <input type="hidden" id="com_area" name="com_area_id" value="{{ $edit_company->com_area_id }}">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector<span style="color: red">*</span></label>
                            <select name="com_sector_id" id="com_sector" class="form-control form-control-sm select2">
                                <option value="">Select Sector</option>
                                @foreach ($get_sector as $sector)
                                    <option value="{{ $sector->sector_id }}"
                                        {{ $sector->sector_id == $edit_company->com_sector_id ? 'selected' : '' }}
                                        data-region="{{ $sector->sec_region_id }}" data-area="{{ $sector->sec_area_id }}">
                                        {{ $sector->sec_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <input type="hidden" value="{{ $edit_company->com_region_id }}" id="com_region" name="com_region_id">
                    <input type="hidden" value="{{ $edit_company->com_area_id }}" id="com_area" name="com_area_id">
                    <input type="hidden" value="{{ $edit_company->com_sector_id }}" id="com_sector" name="com_sector_id">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Town<span style="color: red">*</span></label>
                            <select name="com_town_id" id="com_town" class="form-control form-control-sm">
                                <option selected disabled hidden>Choose Town</option>
                                @foreach ($get_town as $town)
                                    <option value="{{ $town->town_id }}"
                                        {{ $town->town_id == $edit_company->com_town_id ? 'selected' : '' }}
                                         data-region="{{ $town->town_region_id }}"
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
                                @foreach ($business_category as $category)
                                    <option value="{{ $category->business_category_id }}"
                                        {{ $category->business_category_id == $edit_company->business_category_id ? 'selected' : '' }}>
                                        {{ $category->business_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Client Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" id="company"
                                aria-describedby="emailHelp" name="comp_name" value="{{ $edit_company->company_name }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Web Address<span style="color: red">*</span></label>
                            <input type="text" name="web_address" id="poc_web_address"
                                class="form-control form-control-sm" autocomplete="off"
                                value="{{ $edit_company->comp_webaddress }}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Mobile Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $edit_company->comp_mobile_no }}" id="poc_mob" name="mobile"
                                data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Whatsapp Number<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $edit_company->comp_whatsapp_no }}" id="poc_w_mob" name="whatsapp"
                                data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control form-control-sm"
                                value="{{ $edit_company->comp_email }}" id="poc_email" name="email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Ptcl No<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $edit_company->comp_ptcl }}" id="ptcl" name="ptcl">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Address<span style="color: red">*</span></label>
                            <textarea name="address" id="" cols="30" rows="1" class="form-control form-control-sm">{{ $edit_company->comp_address }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Map Coordinates<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $edit_company->map_coordinate }}" id="map_coordinate" name="map_coordinate">
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" id="poc_status" name="status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->sta_id }}"
                                        {{ $edit_company->comp_status == $item->sta_id ? 'selected' : '' }}>
                                        {{ $item->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Remarks</label>
                            <textarea name="comp_remarks" id="" cols="30" rows="1" class="form-control form-control-sm"
                                placeholder="Add Remarks">{{ $edit_company->comp_remarks }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" id="add_comp" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('document').ready(function() {
        $('#com_town').select2();
        $('#business_category').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#edit_company_form').validate({
                rules: {
                    com_sector_id: {
                        required: true,
                        minlength: 1,
                    },
                    business_category: {
                        required: true,
                    },
                    comp_name: {
                        letterandspace: true,
                        required: true,
                        minlength: 3,
                        maxlength: 30,
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

                },
                messages: {
                    equalTo: 'Select the sector'
                }
            });
        });

        $(document).ready(function() {
            $('#com_sector').change(function() {
                var region = $('#com_region').val($('#com_sector option:selected').data('region'));
                var area = $('#com_area').val($('#com_sector option:selected').data('area'));
            })
        });

        $('#poc_mob').keyup(function() {
            $('#poc_w_mob').val($(this).val());
        });
    </script>
@endsection
