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
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Username</th>
                    <th onclick="sortTable(3)">Email</th>
                    <th onclick="sortTable(4)">Mobile</th>
                    <th onclick="sortTable(5)">Address</th>
                    <th onclick="sortTable(6)">Role</th>
                    <th onclick="sortTable(7)">Groups</th>
                    <th onclick="sortTable(8)">Supervisor</th>
                    <th onclick="sortTable(9)">Image</th>
                    <th onclick="sortTable(10)">Created At</th>
                    <th>Status</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $info)
                    <tr>
                        <td>{{ $index + $datas->firstItem() }}</td>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->username }}</td>
                        <td>{{ $info->email }}</td>
                        <td>{{ $info->mob }}</td>
                        <td>{{ $info->address }}</td>
                        <td>{{ $info->role }}</td>
                        @php
                            $groups = \App\Models\Group::whereIn('groups_id', explode(',', $info->group_id))
                                ->select('groups_name')
                                ->get();
                        @endphp
                        <td>
                            @foreach ($groups as $subject)
                                {{ $subject->groups_name }},
                            @endforeach
                        </td>
                        <td>{{ $info->supervisor_name }}</td>
                        <td><img src="{{ asset('public/storage/img/' . $info->image) }}" width="20px" height="auto"
                                alt=""></td>
                        <td>{{ date('d-M-Y', strtotime($info->created_at)) }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="{{ $info->id }}" data-onstyle="success" data-offstyle="danger"
                                    class="form-check-input toggle-class" type="checkbox" id="flexSwitchCheckChecked"
                                    {{ $info->user_status ? 'checked' : '' }}>
                            </div>
                        </td>

                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                <a href="{{ Route('edituser', 'id=' . $info->id) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteuser', 'id=' . $info->id) }}"
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
        {{-- {{ $datas->links() }} --}}
        @if (empty($type))
            <div class="m-2">
                {{ $datas->appends(request()->except(['page', '_token']))->links() }}
                {{-- {{ $datas->links() }} --}}
            </div>
        @endif
    @else
        <h1 class="text-center">Data Not Found</h1>
    @endif
@endsection
