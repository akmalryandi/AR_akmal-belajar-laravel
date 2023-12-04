@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Sales</h3>
        </div>
        <form id="search" method="get" action="{{ route('salesdetail') }}">
            <div class="d-flex bd-highlight mt-3">
                <div class="me-auto bd-highlight">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('salesdetail.create') }}" type="button" class="btn btn-primary ms-3"><i
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
                        <th>Code Sales</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th style="width: 15%;">Description Product</th>
                        <th>Quantity</th>
                        <th>Amount Total</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesDetails as $data)
                        <tr>

                            <td>{{ $data->code_sale }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->product_name }}</td>
                            <td style="width: 15%;">{{ $data->description }}</td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->amount_total }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td><a href="{{ route('salesdetail.edit', ['id' => $data->id]) }}"> <button
                                            class="btn btn-secondary"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="{{ route('salesdetail.delete', ['id' => $data->id]) }}"> <button
                                            class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $salesDetails->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
