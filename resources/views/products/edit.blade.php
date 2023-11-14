@extends('pages.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="POST" action="{{route("products.update",$product->id)}}">
                            @method('put')
                            @csrf
                            <div class="card-body row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input name="nama" type="text" class="form-control" id="nama"
                                        placeholder="Enter Name" autocomplete="off" value="{{ $product->product_name }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" cols="5" rows="2" placeholder="Enter description"
                                        required>{{ $product->description }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input name="price" type="text" class="form-control" id="harga"
                                        placeholder="Enter Harga" autocomplete="off" value="{{ $product->price }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input name="stock" type="text" class="form-control" id="stok"
                                        placeholder="Enter Stok" autocomplete="off" value="{{ $product->stock }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input name="product_code" type="text" class="form-control" id="kode_produk"
                                        placeholder="Enter Kode Produk" autocomplete="off" value="{{ $product->product_code }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category">Kategori</label>
                                    <select id="category" name="category" class="form-control">
                                        <option>Pilih Kategori</option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ $product->category_id == $id ? 'selected' : '' }}>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-secondary">Submit</button>
                                <a href="{{ route('products') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
