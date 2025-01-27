@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">Edit Company</div>
        <div class="card-body">
            <form action="{{route('updateCompany', 'id='.$edit_company->id)}}" method="post">
                @csrf
                <div class="row">
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Region</label>--}}
{{--                            <select name="com_region_id" id="com_region" class="form-control form-control-sm">--}}
{{--                                <option selected disabled hidden>Choose Region</option>--}}
{{--                                @foreach($get_region as $region)--}}
{{--                                    <option value="{{$region->region_id}}" {{$region->region_id == $edit_company->com_region_id ? 'selected' : ''}}>{{$region->reg_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Area</label>--}}
{{--                            <select name="com_area_id" id="com_area" class="form-control form-control-sm">--}}
{{--                                <option selected disabled hidden>Choose Region</option>--}}
{{--                                @foreach($get_area as $area)--}}
{{--                                    <option value="{{$area->area_id}}" {{$area->area_id == $edit_company->com_area_id ? 'selected' : ''}}>{{$area->area_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Sector</label>--}}
{{--                            <select name="com_sector_id" id="com_sector" class="form-control form-control-sm">--}}
{{--                                <option selected disabled hidden>Choose Region</option>--}}
{{--                                @foreach($get_sector as $sector)--}}
{{--                                    <option value="{{$sector->sector_id}}" {{$sector->sector_id == $edit_company->com_sector_id ? 'selected' : ''}}>{{$sector->sec_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <input type="hidden" value="" id="com_region" name="com_region_id">
                    <input type="hidden" value="" id="com_area" name="com_area_id">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sector</label>
                            <select name="com_sector_id" id="com_sector" class="form-control form-control-sm">
                                @foreach ($get_sector as $sector)
                                    <option value="{{$sector->sector_id}}" {{$sector->sector_id == $edit_company->com_sector_id ? 'selected' :''}} data-region="{{$sector->sec_region_id}}" data-area="{{$sector->sec_area_id}}">{{$sector->sec_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Business Category</label>
                            <select name="business_category" class="form-control form-control-sm">
                                @foreach ($business_category as $category)
                                    <option value="{{$category->business_category_id}}" {{$category->business_category_id == $edit_company->business_category_id ? 'selected':''}}>{{$category->business_category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company</label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" id="company" aria-describedby="emailHelp" name="comp_name" value="{{$edit_company->company_name}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company Remarks</label>
                            <textarea name="comp_remarks" id="" cols="30" rows="1" class="form-control form-control-sm" placeholder="Add Remarks">{{$edit_company->comp_remarks}}</textarea>
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
        $(document).ready(function () {
            $('#com_sector').change(function () {
                var region = $('#com_region').val($('#com_sector option:selected').data('region'));
                var area = $('#com_area').val($('#com_sector option:selected').data('area'));
            })
        })

    </script>
@endsection
