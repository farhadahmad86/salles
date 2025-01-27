@extends('layouts/app')
@section('styles')

@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit Order</div>
        <div class="card-body">
            <form action="{{route('updateOrder', 'id='.$edit->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Date:</label>
                            <input type="date" name="date" class="form-control" value="{{$orderInfo->sale_date}}"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Company</label>
                            <select class="form-control" name="comp_id">
                                <option disabled hidden selected>Choose...</option>
                                @foreach($compName as $name)
                                    <option value="{{$name->id}}" {{$name->id == $edit->company_id ? 'selected' : ''}}>{{$name->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">POC</label>
                            <input type="text" class="form-control" id="" name="poc" value="{{$orderInfo->poc}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">MOB</label>
                            <input type="text" class="form-control" id="" name="mob" value="{{$orderInfo->mob}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" id="" name="email" value="{{$orderInfo->email}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">MRC</label>
                            <input type="text" class="form-control" id="" name="mrc" value="{{$orderInfo->mrc}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">OTC</label>
                            <input type="text" class="form-control" id="" name="otc" value="{{$orderInfo->otc}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control" id="" name="status" value="{{$orderInfo->status}}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection


@section('javascript')

@endsection
