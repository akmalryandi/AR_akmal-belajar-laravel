@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Products</h3>
            {{-- <a href="#" type="button" class="btn btn-outline-light"><i class="bi bi-plus-lg"></i></a> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="{{ route('products.create') }}" type="button" class="btn btn-primary mb-2"><i
                    class="bi bi-plus-lg"></i></a>
            <table id="example1" class="table table-bordered table-striped mb-3">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kode Produk</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $data)
                        <tr>
                            <td>{{ $data->product_name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ $data->stock }}</td>
                            <td>{{ $data->product_code }}</td>
                            <td>{{ $data->category_name }}</td>
                            <td><a href="{{ route('products.edit', ['id' => $data->id]) }}"> <button
                                        class="btn btn-secondary m-2"><i class="bi bi-pencil-square"></i></button></a>
                                <a href="{{ route('products.delete', ['id' => $data->id]) }}"> <button
                                        class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
