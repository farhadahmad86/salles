@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create Unit</div>
        <div class="card-body">
            <form action="{{route('unitStore')}}" method="post" id="unit">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Main Unit</label>
                            <select name="main_unit" id="" class="form-control form-control-sm">
                                <option disabled selected hidden>Choose</option>
                                @foreach($main_unit as $item)
                                    <option value="{{$item->main_unit_id}}">{{$item->main_unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Scale Size</label>
                            <input type="text" name="unit_scale_size" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="unit_remarks" class="form-control form-control-sm" cols="30" rows="1">{{old('unit_remarks')}}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function () {
            $('#unit').validate({
                rules: {
                    unit: {
                        required: true,
                    }
                }
            });
        });
    </script>
@endsection

