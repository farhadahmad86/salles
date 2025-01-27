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
                    <th onclick="sortTable(1)">Subject Id</th>
                    <th onclick="sortTable(2)" style="width: 9%;">Date</th>
                    <th onclick="sortTable(3)">Versions</th>
                    <th onclick="sortTable(4)">Parent Version</th>
                    <th onclick="sortTable(5)">Child Version</th>
                    <th onclick="sortTable(6)">Company</th>
                    <th onclick="sortTable(7)">POC</th>
                    <th onclick="sortTable(8)">Grand Total</th>
                    <th onclick="sortTable(9)">Created By</th>
                    <th onclick="sortTable(6)">Quotation Remarks</th>
                    <th onclick="sortTable(10)">Expiry Date</th>
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
                        <td>{{ $info->unique_id }}</td>
                        <td>{{ $info->inv_date }}</td>
                        <td>V-{{ $info->version }}</td>
                        @if ($info->link == null)
                            <td></td>
                        @else
                            <td>{{ $info->link }}</td>
                        @endif
                        <td>{{ $info->version_use }}</td>
                        <td>{{ $info->company_name }}</td>
                        <td>{{ $info->poc_name }}</td>
                        <td>{{ number_format($info->grand_total, 2) }}</td>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->quotation_remarks }}</td>
                        <td>{{ $info->expiry_date }}</td>
                        @if (empty($type))
                            <td style="text-align: center">
                                @if ($info->expiry_date >= $current_date)
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu"> --}}
                                    @if (Auth::user()->role != 'Tele Caller')
                                        <a href="#" class="invoice_view_modal" data-toggle="modal"
                                            data-target="#invoice_modal_{{ $info->invoice_id }}"><i class="fa-solid fa-eye"
                                                style="font-size:16px;color: rgb(50, 152, 195)"></i>
                                        </a>
                                        @if (count($reminder) > 0)
                                            @if ($info->invoice_user_id == Auth::user()->id)
                                                <a class="" href="#" data-toggle="modal"
                                                    data-target=".reminder_no_{{ $info->invoice_id }}"><i
                                                        class="fa-solid fa-bell"
                                                        style="font-size:16px; color: #ffbb00 "></i></a>
                                            @endif
                                        @endif
                                    @else
                                        <a class="" href="#" data-toggle="modal"
                                            data-target=".remarks_no_{{ $info->invoice_id }}"><i
                                                class="fa-brands fa-rocketchat"
                                                style="font-size:16px; color: #920CA4"></i></a>
                                    @endif
                                    @if (\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                                        <a href="{{ route('deleteInvoice')}}?id={{ $info->invoice_id }}" class=""
                                            onclick="return confirm('Are you sure to Delete this data?');"><i
                                                class="fa-sharp fa-solid fa-trash"
                                                style="font-size:16px;color: red"></i></a>
                                    @endif
                                    {{-- @if (\Illuminate\Support\Facades\Auth::user()->role == 'Admin') --}}
                                    <a href="{{ route('versionqoutation')}}?id={{ $info->invoice_id }}" class=""
                                        onclick="return confirm('Are you to sure want to create Version?');"><i
                                            class="fa-solid fa-file-circle-plus" style="font-size:16px; color: #ae00ff"></i>
                                    </a>
                                    {{-- @endif --}}
                                    {{-- </div>
                                    </div> --}}
                                @else
                                    <!-- Button trigger modal -->
                                    @if (Auth::user()->role != 'Tele Caller')
                                        @if ($info->status == 'PENDING')
                                            <b>Pending</b>
                                        @else
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                onclick="get_id({{ $info->invoice_id }})">
                                                <i class="fa-solid fa-calendar-xmark"
                                                    style="font-size:16px; color: #0015ff"></i>
                                            </a>
                                        @endif
                                        <a href="#" class="invoice_view_modal" data-toggle="modal"
                                            data-target="#invoice_modal_{{ $info->invoice_id }}"><i class="fa-solid fa-eye"
                                                style="font-size:16px;color: rgb(50, 152, 195)"></i>
                                        </a>
                                    @endif
                                @endif


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
    <script>
        function get_id(id) {
            $('#id').val(id);
        }
    </script>
@endsection
