@extends('print.print_index')

@if ($type !== 'download_excel')
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
                    <th onclick="sortTable(3)">Remarks</th>
                    <th onclick="sortTable(4)">Created By</th>
                    <th onclick="sortTable(5)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $area)
                    <tr>
                        <th>{{ $key + $datas->firstItem() }}</th>
                        <td>{{ $area->reg_name }}</td>
                        <td>{{ $area->area_name }}</td>
                        <td>{{ $area->area_remarks }}</td>
                        <td>{{ $area->name }}</td>
                        <td>{{ date('d-M-Y', strtotime($area->area_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu"> --}}
                                <a href="{{ Route('editArea', 'id=' . $area->area_id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteArea', 'id=' . $area->area_id) }}"
                                    onclick="return confirm('Are you to Delete this data?');" class=""><i
                                        class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                {{-- </div>
                            </div> --}}
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
