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
                    <th onclick="sortTable(3)">town</th>
                    <th onclick="sortTable(4)">Company Name</th>
                    <th onclick="sortTable(5)">Business Category</th>
                    <th onclick="sortTable(6)">Email</th>
                    <th onclick="sortTable(7)">Mobile No</th>
                    <th onclick="sortTable(8)">Whatsapp No</th>
                    <th onclick="sortTable(9)">Ptcl</th>
                    <th onclick="sortTable(9)">Address</th>
                    <th onclick="sortTable(10)">Status</th>
                    <th onclick="sortTable(12)">Created By</th>
                    <th onclick="sortTable(13)">Created At</th>
                    <th onclick="sortTable(14)">Remarks</th>
                    <th onclick="sortTable(11)">Map Coordinates</th>
                    {{-- @if (empty($type)) --}}
                    @if (Auth::user()->role == 'Admin')
                        <th>Actions</th>
                    @endif


                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $company)
                    <tr>
                        <td>{{ $key + $datas->firstItem() }}</td>
                        <td>{{ $company->reg_name }}</td>
                        <td>{{ $company->area_name }}</td>
                        <td>{{ $company->sec_name }}</td>
                        <td>{{ $company->town_name }}</td>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->business_category_name }}</td>
                        <td>{{ $company->comp_email }}</td>
                        <td>{{ $company->comp_mobile_no }}</td>
                        <td>{{ $company->comp_whatsapp_no }}</td>
                        <td>{{ $company->comp_ptcl }}</td>
                        <td>{{ $company->comp_address }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="{{ $company->comp_id }}" data-onstyle="success" data-offstyle="danger"
                                    class="form-check-input toggle-class" type="checkbox" id="flexSwitchCheckChecked"
                                    {{ $company->comp_status ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $company->name }}</td>
                        <td style="width: 6%;">
                            {{ date('d-M-Y', strtotime($company->company_created_at)) }}</td>
                        <td>{{ $company->comp_remarks }}</td>

                        <td style="text-align: center"><a
                                href="https://www.google.com/maps?q={{ $company->map_coordinate }}" target="_blank"><i
                                    class="fa-solid fa-location-crosshairs"
                                    style="font-size:16px;color: #17a2b8;text-align: center"></i></a>
                        </td>
                        @if (empty($type))
                            <td>
                                @if (Auth::user()->role == 'Admin')
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu"> --}}
                                    <a href="{{ route('editClients', 'id=' . $company->comp_id) }}" class=""><i
                                            class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                    <a href="{{ route('deleteClients', 'id=' . $company->comp_id) }}"
                                        onclick="return confirm('Are you want to Delete this data?');" class=""><i
                                            class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                    {{-- </div>
                                    </div> --}}
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
@endsection
