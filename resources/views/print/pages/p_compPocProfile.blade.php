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
                <th onclick="sortTable(1)">Company Name</th>
                <th onclick="sortTable(2)">Name</th>
                <th onclick="sortTable(3)">Designation</th>
                <th onclick="sortTable(4)">Mobile No</th>
                <th onclick="sortTable(5)">Whatsapp No</th>
                <th onclick="sortTable(6)">Email</th>
                <th onclick="sortTable(7)">Status</th>
                <th onclick="sortTable(8)">Created At</th>
                <th onclick="sortTable(9)">Created By</th>
                @if (empty($type))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $key=>$profile)
                <tr>
                    <td>{{$key + $datas->firstItem()}}</td>
                    <td>{{$profile->company_name}}</td>
                    <td>{{$profile->com_poc_profile_name}}</td>
                    <td>{{$profile->com_poc_profile_designation}}</td>
                    <td>{{$profile->com_poc_profile_mobile_no}}</td>
                    <td>{{$profile->com_poc_profile_whatsapp_no}}</td>
                    <td>{{$profile->com_poc_profile_email}}</td>
                    <td>{{$profile->com_poc_profile_status}}</td>
                    <td>{{date('d-M-Y', strtotime($profile->com_poc_profile_created_at))}}</td>
                    <td>{{$profile->name}}</td>
                    @if (empty($type))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('editCompPocProfile', 'id='.$profile->com_poc_profile_id)}}" class="dropdown-item">Edit</a>
                                    <a href="{{route('deleteCompPocProfile', 'id='.$profile->com_poc_profile_id)}}" onclick="return confirm('Are you to Delete this data?');" class="dropdown-item">Delete</a>
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


