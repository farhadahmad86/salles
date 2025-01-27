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
                <th onclick="sortTable(2)">Email</th>
                <th onclick="sortTable(3)">Mobile No</th>
                <th onclick="sortTable(4)">Whatsapp No</th>
                <th onclick="sortTable(5)">Ptcl</th>
                <th onclick="sortTable(6)">Created By</th>
                <th onclick="sortTable(7)">Status</th>
                <th onclick="sortTable(8)">Created At</th>
                <th onclick="sortTable(9)">Address</th>
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
                    <td>{{$profile->comprofile_email}}</td>
                    <td>{{$profile->comprofile_mobile_no}}</td>
                    <td>{{$profile->comprofile_whatsapp_no}}</td>
                    <td>{{$profile->comprofile_ptcl}}</td>
                    <td>{{$profile->name}}</td>
                    <td>{{$profile->sta_status}}</td>
                    <td>{{date('d-M-Y', strtotime($profile->comprofile_created_at))}}</td>
                    <td>{{$profile->comprofile_address}}</td>
                    @if (empty($type))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('editCompProfile', 'id='.$profile->comprofile_id)}}" class="dropdown-item">Edit</a>
                                    <a href="{{route('deleteCompProfile', 'id='.$profile->comprofile_id)}}" onclick="return confirm('Are you to Delete this data?');" class="dropdown-item">Delete</a>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (empty($type))
        <div class="m-2">
                {{ $datas->appends(request()->except(['page', '_token']))->links() }}
            </div>
        @endif
    @else
        <h1 class="text-center">Data Not Found</h1>
    @endif
@endsection


