@extends('print.print_index')

@if( $type !== 'download_excel')
    @section('print_title', $pge_title)
@endif

@section('print_cntnt')
    @if ($count_row > 0)
        <table class="table" id="myTable">
            <thead>
            <tr>
                <th onclick="sortTable(0)">#</th>
                <th onclick="sortTable(1)">Region</th>
                <th onclick="sortTable(2)">Area</th>
                <th onclick="sortTable(3)">Sector</th>
                <th onclick="sortTable(4)">Company</th>
                <th onclick="sortTable(5)">Business Category</th>
                <th onclick="sortTable(6)">Created By</th>
                <th onclick="sortTable(7)">Created At</th>
                <th onclick="sortTable(8)">Remarks</th>
                @if (empty($type))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $key => $company)
                <tr>
                    <td>{{$key + $datas->firstItem()}}</td>
                    <td>{{$company->reg_name}}</td>
                    <td>{{$company->area_name}}</td>
                    <td>{{$company->sec_name}}</td>
                    <td>{{$company->company_name}}</td>
                    <td>{{$company->business_category_name}}</td>
                    <td>{{$company->name}}</td>
                    <td>{{ date('d-M-Y',strtotime($company->company_created_at)) }}</td>
                    <td>{{$company->comp_remarks}}</td>
                    @if (empty($type))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('editCompany', 'id='.$company->comp_id)}}" class="dropdown-item">Edit</a>
                                    <a href="{{route('deleteCompany', 'id='.$company->comp_id)}}" onclick="return confirm('Are you want to Delete this data?');" class="dropdown-item">Delete</a>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (empty($type))
            <div class="mt-4 float-right">
                {{ $datas->appends(request()->except(['page', '_token']))->links() }}
            </div>
        @endif
    @else
        <h1 class="text-center">Data Not Found</h1>
    @endif
@endsection


