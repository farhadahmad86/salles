@extends('layouts/app')
@section('styles')
    <style>
        #category-error {
            position: fixed;
            margin-top: 62px;
            margin-left: -64px;
        }
    </style>
@endsection
@section('content')
    <div class="card ">
        <div class="card-header">Edit Funnel</div>
        <div class="card-body">
            <form action="{{ route('updateFunnel', 'id=' . $edit->id) }}" method="post" id="edit_funnel_form">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Date:<span style="color: red">*</span></label>
                            <input type="text" name="date" id="date" value="{{ $edit->date }}"
                                class="form-control form-control-sm" autocomplete="off" placeholder="Choose Date..."
                                style="width: 103%" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" name="comp_id" id="myComp">
                                @foreach ($all_comp as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $edit->company_id == $company->id ? 'selected' : '' }}>
                                        {{ ucfirst($company->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">OTC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id=""
                                value="{{ $edit->otc }}" name="otc">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">MRC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id=""
                                value="{{ $edit->mrc }}" name="mrc">
                        </div>
                    </div>
                    {{--                    <div class="col-md-4"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="">POC</label> --}}
                    {{--                            <select class="form-control form-control-sm" name="poc" id="poc"> --}}
                    {{--                                @foreach ($all_comp_poc_profile as $profile) --}}
                    {{--                                    <option value="{{$profile->com_poc_profile_id}}" {{$profile->com_poc_profile_id == $edit->company_pro_id ? 'selected' : ''}}>{{$profile->com_poc_profile_name}}</option> --}}
                    {{--                                @endforeach --}}
                    {{--                            </select> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    {{--                <div class="form-group"> --}}
                    {{--                    <label for="">Official Address</label> --}}
                    {{--                    <textarea name="offAdd" id="" cols="30" rows="1" class="form-control form-control-sm">{{$edit->official_address}}</textarea> --}}
                    {{--                </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" multiple="multiple" name="category[]"
                                data-placeholder="Choose Category" id="category">
                                @foreach ($all_category as $category)
                                    @php
                                        $all_category = explode(',', $edit->category_id);
                                    @endphp
                                    <option value="{{ $category->cat_id }}"
                                        {{ in_array($category->cat_id, $all_category) ? 'selected' : '' }}>
                                        {{ $category->cat_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category Remarks</label>
                            <textarea name="cat_remarks" class="form-control form-control-sm" id="" cols="30" rows="1">{{ $edit->cat_remarks }}</textarea>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="status">
                                @foreach ($all_status as $status)
                                    <option value="{{ $status->sta_id }}"
                                        {{ $status->sta_id == $edit->status_id ? 'selected' : '' }}>
                                        {{ $status->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Status Remarks</label>
                            <textarea value="{{ $edit->status_remarks }}" name="sta_remarks" id="" cols="30" rows="1"
                                class="form-control form-control-sm">{{ $edit->status_remarks }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#date').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('document').ready(function() {
            $('#comp_id').select2();
            $('#category').select2();
            $('#edit_funnel_form').validate({
                ignore: [],
                rules: {
                    date: {
                        required: true,
                    },
                    comp_id: {
                        required: true,
                    },
                    poc: {
                        required: true,
                    },
                    offAdd: {
                        maxlength: 500,
                    },
                    status: {
                        required: true,
                    },
                    sta_remarks: {
                        maxlength: 500,
                    },
                    category: {
                        required: true,
                    },
                    cat_remarks: {
                        maxlength: 500,
                    },
                    potenCus: {
                        required: true,
                        digits: true,
                    },
                    mrc: {
                        required: true,
                        digits: true,
                    },
                    otc: {
                        required: true,
                        digits: true,
                    },
                    'category[]': {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
