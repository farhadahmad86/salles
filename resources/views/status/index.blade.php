@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4 table-responsive">
        <div class="card-header">All Status</div>
        <div class="card-body">
            @if (count($allStatus) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allStatus as $status)
                            <tr>
                                <td>{{ $status->sta_status }}</td>
                                <td>{{ date('d-M-Y', strtotime($status->created_at)) }}</td>
                                <td>
                                    {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                    <a href="{{ route('editStatus', 'id=' . $status->sta_id) }}" class=""><i
                                            class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                    <a href="{{ route('deleteStatus', 'id=' . $status->sta_id) }}"
                                        onclick="return confirm('Are you to Delete this data?');" class=""><i
                                            class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
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
@endsection

@section('javascript')
@endsection
