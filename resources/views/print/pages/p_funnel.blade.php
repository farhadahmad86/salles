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
                    <th onclick="sortTable(1)">Date</th>
                    <th onclick="sortTable(2)">Company</th>
                    <th onclick="sortTable(3)">OTC</th>
                    <th onclick="sortTable(4)">MRC</th>
                    <th onclick="sortTable(5)">Product Category</th>
                    <th onclick="sortTable(6)">Status</th>
                    <th onclick="sortTable(7)">Created By</th>
                    <th onclick="sortTable(8)">Status Remarks</th>
                    <th onclick="sortTable(9)">Category Remarks</th>
                    <th onclick="sortTable(10)">Created At</th>
                    @if (empty($type))
                        <?php
                if (Auth::user()->role != 'Tele Caller'){
                ?>
                        <th>Action</th>
                        <?php
                }else{
                ?>
                        <th>Action</th>
                        <?php
                }
                ?>
                    @endif
                </tr>
            </thead>
            <tbody id="table_row">
                @foreach ($datas as $key => $info)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $info->date }}</td>
                        <td>{{ $info->company_name }}</td>
                        <td>{{ $info->otc }}</td>
                        <td>{{ $info->mrc }}</td>
                        @php
                            $category = \App\Models\Category::whereIn('cat_id', explode(',', $info->category_id))
                                ->select('cat_category')
                            ->get(); @endphp
                        <td>
                            @foreach ($category as $subject)
                                {{ $subject->cat_category }},
                            @endforeach
                        </td>

                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="{{ $info->id }}" data-onstyle="success" data-offstyle="danger"
                                    class="form-check-input toggle-class" type="checkbox" id="flexSwitchCheckChecked"
                                    {{ $info->status_id ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->status_remarks }}</td>
                        <td>{{ $info->cat_remarks }}</td>
                        <td>{{ date('d-M-Y', strtotime($info->funnel_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action
                            </button>
                            <div class="dropdown-menu"> --}}
                                <?php
                                if (Auth::user()->role != 'Tele Caller'){
                                ?>
                                <a href="{{ Route('editFunnel', 'id=' . $info->funId) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('deleteFunnel', 'id=' . $info->funId) }}"
                                    onclick="return confirm('Are you to Delete this data?');" class=""><i
                                        class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                @if (count($reminder) > 0)
                                    @if ($info->funnel_user_id == Auth::user()->id)
                                        <a class="" href="#" data-toggle="modal"
                                            data-target=".reminder_no_{{ $info->funId }}"><i class="fa-solid fa-bell"
                                                style="font-size:16px; color: #ffbb00 "></i></a>
                                    @endif
                                @endif
                                <?php
                                }else{
                                ?>
                                {{--                                    @if ($info->funnel_reminder_reason != null) --}}
                                {{--                                        <a class="" href="#" data-toggle="modal" data-target=".has_reminder_{{$info->funId}}">Reminder <span class="fa fa-check" style="color: #00ff80"></span></a> --}}
                                {{--                                        @else --}}
                                {{--                                        <a class="" href="#" data-toggle="modal" data-target=".reminder_no_{{$info->funId}}">Reminder</a> --}}
                                {{--                                    @endif --}}
                                <a class="" href="#" data-toggle="modal"
                                    data-target=".remarks_no_{{ $info->funId }}"><i class="fa-brands fa-rocketchat"
                                        style="font-size:16px; color: #920CA4"></i></a>
                                <?php
                                }
                                ?>
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
