@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card mt-4 table-responsive">
        <div class="card-header">Expiry Days</div>
        <div class="card-body">
            @if (count($expiry_days) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Days</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expiry_days as $expiry)
                            <tr>
                                <td>{{ $expiry->id }}</td>
                                <td>{{ $expiry->days }}</td>
                                <td style="text-align: center">
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action
                                        </button>
                                    <div class="dropdown-menu"> --}}
                                    <a href="{{ route('edit_expiry_days', 'id=' . $expiry->id) }}" class=""><i
                                            class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
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
