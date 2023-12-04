@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Users</h3>
        </div>
        <!-- /.card-header -->
        <form id="search" method="get" action="{{ route('users') }}">
            <div class="d-flex bd-highlight ms-3 mt-3">
                <div class="bd-highlight me-1">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search"
                        autocomplete="off">
                </div>
                <div class="bd-highlight">
                    <button type="submit" name="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="card-body">

            <table id="example1" class="table table-bordered table-responsive table-striped mb-3">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Username</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Password</th>
                        @endif
                        <th>Role</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td>{{ $data->username }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td>{{ $data->password }}</td>
                            @endif
                            <td>{{ $data->role }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td>
                                    {{-- <a href="{{ route('products.edit', ['id' => $data->id]) }}"> <button
                                            class="btn btn-secondary mb-2"><i class="bi bi-pencil-square"></i></button></a> --}}
                                    <a href="{{ route('users.delete', ['id' => $data->id]) }}"> <button
                                            class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $user->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
