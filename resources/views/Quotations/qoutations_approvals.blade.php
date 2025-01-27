@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4 table-responsive">
        <div class="card-header">Approvals</div>
        <div class="card-body">
            @if (count($approvals) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Subject Id</th>
                            <th>User Name</th>
                            <th>Request Time</th>
                            <th>Approval Time</th>
                            <th>Refuse Time</th>
                            <th>Approved By</th>
                            <th>Refused By</th>
                            <th>Remarks</th>
                            <th>Refused Remarks</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvals as $key => $approval)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $approval->unique_id }}</td>
                                <td>{{ $approval->name }}</td>
                                <td>{{ $approval->request_time }}</td>
                                <td>{{ $approval->approve_time }}</td>
                                <td>{{ $approval->refuse_time }}</td>
                                <td>
                                    @if ($approval->status == 'Approved')
                                        {{ $approval->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($approval->status == 'Refused')
                                        {{ $approval->name }}
                                    @endif
                                </td>
                                <td>{{ $approval->remarks }}</td>
                                <td>{{ $approval->refues_remarks }}</td>
                                <td>{{ $approval->status }}</td>
                                <td>
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu"> --}}
                                    @if ($approval->status != 'Approved' && $approval->status != 'Refused')
                                        <a href="{{ route('approval_expiry_date')}}?id={{ $approval->id }}" class=""><i
                                                class="fas fa-clipboard-check"style="font-size: 16px"></i>
                                        </a>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            onclick="get_id({{ $approval->id }})">
                                            <i class="fa-solid fa-ban"></i>
                                        </a>
                                    @else
                                        <p>No Action
                                            Required</p>
                                    @endif

                                    {{-- </div>
    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Status not found.</p>
            @endif
        </div>
    </div>
    <form action="{{ route('refuse_approval') }}" method="POST">
        @csrf

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-group" name="refuse_remarks" id="refuse_remarks">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function get_id(id) {
            $('#id').val(id);
        }
    </script>
@endsection

@section('javascript')
@endsection
