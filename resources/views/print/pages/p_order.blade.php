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
                    <th onclick="sortTable(1)">Order No</th>
                    <th onclick="sortTable(2)">Date</th>
                    <th onclick="sortTable(3)">Company</th>
                    <th onclick="sortTable(4)">Grand Total</th>
                    <th onclick="sortTable(5)">Created By</th>
                    <th onclick="sortTable(6)">Created At</th>
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
            <tbody class="table_row">
                @foreach ($datas as $key => $info)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $info->order_no }}</td>
                        <td>{{ $info->sale_date }}</td>
                        <td>{{ $info->company_name }}</td>
                        <td>{{ number_format($info->grand_total, 2) }}</td>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->order_created_at }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                @if (Auth::user()->role != 'Tele Caller')
                                    <a href="#" class="order_view_modal" data-toggle="modal"
                                        data-target=".order_modal_{{ $info->order_id }}"><i class="fa-solid fa-eye"
                                            style="font-size:16px;color: rgb(50, 152, 195)"></i></a>
                                    @if (count($reminder) > 0)
                                        @if ($info->order_user_id == Auth::user()->id)
                                            <a class="" href="#" data-toggle="modal"
                                                data-target=".reminder_no_{{ $info->order_id }}"><i class="fa-solid fa-bell"
                                                    style="font-size:16px; color: #ffbb00 "></i></a>
                                        @endif
                                    @endif
                                @else
                                    {{--                                        @if ($info->order_reminder_reason != null) --}}
                                    {{--                                            <a class="" href="#" data-toggle="modal" data-target=".has_reminder_{{$info->order_id}}">Reminder <span class="fa fa-check" style="color: #00ff80"></span></a> --}}
                                    {{--                                        @else --}}
                                    {{--                                            <a class="" href="#" data-toggle="modal" data-target=".reminder_no_{{$info->order_id}}">Reminder</a> --}}
                                    {{--                                        @endif --}}
                                    <a class="" href="#" data-toggle="modal"
                                        data-target=".remarks_no_{{ $info->order_id }}"><i class="fa-brands fa-rocketchat"
                                            style="font-size:16px; color: #920CA4"></i></a>
                                @endif
                                @if (\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                                    <a href="{{ route('deleteOrder')}}?id={{ $info->order_id }}" class=""
                                        onclick="return confirm('Are you to Delete this data?');"><i
                                            class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                @endif
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
