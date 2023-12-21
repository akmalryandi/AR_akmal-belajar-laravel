@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Products</h3>
        </div>
        <form id="search" method="get" action="{{ route('products') }}">
            <div class="d-flex bd-highlight mt-3">
                <div class="me-auto bd-highlight">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('products.create') }}" type="button" class="btn btn-primary ms-3"><i
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
                        <th>Image</th>
                        <th>Name</th>
                        <th style="width: 15%;">Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Product Code</th>
                        <th>Category</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $data)
                        <tr>
                            <td>
                                @if ($data->image)
                                    <img class="rounded mb-2" width="100" src="{{ asset(json_decode($data->image)[0]) }}"
                                        alt="{{ $data->product_name }}">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $data->product_name }}</td>
                            <td style="width: 15%;">{{ $data->description }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ $data->stock }}</td>
                            <td>{{ $data->product_code }}</td>
                            <td>{{ $data->category_name }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td><a href="{{ route('products.edit', ['id' => $data->id]) }}"> <button
                                            class="btn btn-secondary"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="{{ route('products.delete', ['id' => $data->id]) }}"> <button
                                            class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
