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
                    <th onclick="sortTable(2)">Remarks</th>
                    <th onclick="sortTable(3)">Created By</th>
                    <th onclick="sortTable(4)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody id="region_table_row">
                @foreach ($datas as $key => $region)
                    <tr>
                        <td>{{ $key + $datas->firstItem() }}</td>
                        <td>{{ $region->reg_name }}</td>
                        <td>{{ $region->reg_remarks }}</td>
                        <td>{{ $region->name }}</td>
                        <td>{{ date('d-M-Y', strtotime($region->reg_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                <a href="{{ Route('editRegion', 'id=' . $region->region_id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteRegion', 'id=' . $region->region_id) }}"
                                    onclick="return confirm('Are you sure to Delete this data?');" class=""><i
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
