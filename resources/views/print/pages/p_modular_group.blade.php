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
                <th onclick="sortTable(1)">Modular Group</th>
                @if (empty($type))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody id="">
            @foreach($modular_groups as $key => $data)
                <tr>
                    <td>{{$key + $datas->firstItem()}}</td>
                    <td>{{$data->name}}</td>
                    @if (empty($type))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{Route('edit_modular_group', 'id='.$data->id)}}" class="dropdown-item">Edit</a>
                                    <a href="{{Route('delete_modular_group', 'id='.$data->id)}}" onclick="return confirm('Are you to Delete this data?');" class="dropdown-item">Delete</a>
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


