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
                    <th onclick="sortTable(1)">Product group</th>
                    <th onclick="sortTable(1)">Category</th>
                    <th onclick="sortTable(2)">Product Name</th>
                    <th onclick="sortTable(3)">UOM</th>
                    <th onclick="sortTable(4)">Description</th>
                    <th onclick="sortTable(5)">Status</th>
                    <th onclick="sortTable(6)">Created By</th>
                    <th onclick="sortTable(7)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $info)
                    <tr>
                        <td>{{ $index + $datas->firstItem() }}</td>
                        <td>{{ $info->product_group_name }}</td>
                        <td>{{ $info->cat_category }}</td>
                        <td>{{ $info->product_name }}</td>
                        <td>{{ $info->unit_name }}</td>
                        <td>{!! $info->description !!}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="{{ $info->id }}" data-onstyle="success" data-offstyle="danger"
                                    class="form-check-input toggle-class" type="checkbox" id="flexSwitchCheckChecked"
                                    {{ $info->product_status ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $info->name }}</td>
                        <td>{{ date('d-M-Y', strtotime($info->created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                <a href="{{ Route('editProduct', 'id=' . $info->id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteProduct', 'id=' . $info->id) }}"
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
