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
                    <th onclick="sortTable(1)">Group Name</th>
                    <th onclick="sortTable(2)">Users</th>
                    <th onclick="sortTable(7)">Created By</th>
                    <th onclick="sortTable(10)">Created At</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody id="table_row">
                @foreach ($datas as $key => $info)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $info->groups_name }}</td>
                        @php
                            $users = \App\User::whereIn('id', explode(',', $info->groups_users))
                                ->select('name')
                                ->get();
                        @endphp
                        <td>
                            @foreach ($users as $subject)
                                {{ $subject->name }},
                            @endforeach
                        </td>

                        </td>
                        <td>{{ $info->username }}</td>
                        <td>{{ date('d-M-Y', strtotime($info->groups_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                <a href="{{ Route('editGroup', 'id=' . $info->groups_id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                {{-- <a href="{{ Route('deleteGroup', 'id=' . $info->groups_id) }}"
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
