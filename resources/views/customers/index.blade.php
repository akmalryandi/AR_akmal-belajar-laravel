@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Customers</h3>
        </div>
        <form id="search" method="get" action="{{ route('customers') }}">
            <div class="d-flex bd-highlight mt-3">
                <div class="me-auto bd-highlight">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary ms-3"><i
                                class="bi bi-plus-lg"></i></a>
                    @endif
                </div>

                <div class="bd-highlight me-1">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search"
                        autocomplete="off">
                </div>
                <div class="bd-highlight me-3">
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
                        <th>Code</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th style="width: 10%;">Email</th>
                        <th style="width: 44%;">Address</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $data)
                        <tr>

                            <td>{{ $data->code_customer }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td style="width: 10%;">{{ $data->email }}</td>
                            <td style="width: 44%;">{{ $data->address }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td><a href="{{ route('customers.edit', ['id' => $data->id]) }}"> <button
                                            class="btn btn-secondary mb-1"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="{{ route('customers.delete', ['id' => $data->id]) }}"> <button
                                            class="btn btn-danger mb-1"><i class="bi bi-trash3-fill"></i></button></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
