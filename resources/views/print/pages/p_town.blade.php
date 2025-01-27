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
                    <th onclick="sortTable(3)">Sector</th>
                    <th onclick="sortTable(4)">Town</th>
                    <th onclick="sortTable(5)">Remarks</th>
                    <th onclick="sortTable(6)">Created By</th>
                    <th onclick="sortTable(7)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $town)
                    <tr>
                        <td>{{ $key + $datas->firstItem() }}</td>
                        <td>{{ $town->reg_name }}</td>
                        <td>{{ $town->area_name }}</td>
                        <td>{{ $town->sec_name }}</td>
                        <td>{{ $town->town_name }}</td>
                        <td>{{ $town->town_remarks }}</td>
                        <td>{{ $town->name }}</td>
                        <td>{{ date('d-M-Y', strtotime($town->town_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                <a href="{{ Route('editTown', 'id=' . $town->town_id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteTown', 'id=' . $town->town_id) }}"
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
