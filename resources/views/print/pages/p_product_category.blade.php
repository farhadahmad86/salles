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
                    <th onclick="sortTable(1)">Product Group</th>
                    <th onclick="sortTable(2)">Category</th>
                    <th onclick="sortTable(3)">Created By</th>
                    <th onclick="sortTable(4)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $category)
                    <tr>
                        <td>{{ $key + $datas->firstItem() }}</td>
                        <td>
                            {{--                        @if ($category->cat_id == $category->product_cat_id) --}}
                            {{ ucfirst($category->product_group_name) }}
                            {{--                        @endif --}}
                            {{--                        @foreach ($cat_product_group_id[$category->cat_id] as $item) --}}
                            {{--                            <span style="background: rgb(212,212,212); border-radius: 3px; padding: 0 5px" ;>{{$item->product_group_name}}</span> --}}
                            {{--                        @endforeach --}}
                        </td>
                        <td>{{ $category->cat_category }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ date('d-M-Y', strtotime($category->created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu"> --}}
                                <a href="{{ route('editCategory', 'id=' . $category->cat_id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ route('deleteCategory', 'id=' . $category->cat_id) }}"
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
