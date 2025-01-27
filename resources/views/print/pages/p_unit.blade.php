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
                <th onclick="sortTable(1)">Main Unit</th>
                <th onclick="sortTable(2)">Unit</th>
                <th onclick="sortTable(3)">Scale Size</th>
                <th onclick="sortTable(4)">Unit Remarks</th>
                <th onclick="sortTable(5)">Created By</th>
                <th onclick="sortTable(6)">Created At</th>
                @if (empty($type))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $index => $item)
                <tr>
                    <td>{{$index + $datas->firstItem()}}</td>
                    <td>{{$item->main_unit_name}}</td>
                    <td>{{$item->unit_name}}</td>
                    <td>{{$item->unit_scale_size}}</td>
                    <td>{{$item->unit_remarks}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{date('d-M-Y', strtotime($item->unit_created_at))}}</td>
                    @if (empty($type))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{Route('unitEdit', 'id='.$item->unit_id)}}" class="dropdown-item">Edit</a>
                                    <a href="{{Route('unitDelete', 'id='.$item->unit_id)}}" onclick="return confirm('Are you to Delete this data?');" class="dropdown-item">Delete</a>
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



