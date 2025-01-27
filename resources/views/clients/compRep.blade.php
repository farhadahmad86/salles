@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 title">
            <h1 class="text-center">Company Reports</h1>
        </div>
    </div>
    <button class="btn btn-primary mt-5" onclick="window.history.back()">Go Back</button>
<a href="{{route('createCompany')}}" class="btn btn-primary mt-5">Create</a>
<div class="card mt-5">
    <div class="card-header">{{$comp}}
        <div class="dropdown float-right">
            <button type="button" class="btn btn-outline-dark dropdown-toggle btn-sm" data-toggle="dropdown">
                Reports
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('company')}}">Show All</a>
                <a class="dropdown-item" href="{{Route('comMonthly')}}">Monthly</a>
                <a class="dropdown-item" href="{{Route('comQuarterly')}}">Quarter</a>
                <a class="dropdown-item" href="{{Route('comYearly')}}">Yearly</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(count($compNames) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Companies</th>
                    <th>Created By</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($compNames as $compName)
                    <tr>
                        <td>{{$compName->company_name}}</td>
                        <td>{{$compName->name}}</td>
                        <td>{{$compName->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Post not found.</p>
        @endif
    </div>
</div>
@endsection


@section('javascript')

@endsection
