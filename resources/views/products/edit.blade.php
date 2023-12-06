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

                        <form method="POST" action="{{ route('products.update', $product->id) }} " enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="card-body row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input name="product_name" type="text" class="form-control" id="nama"
                                        placeholder="Enter Name" autocomplete="off" value="{{ $product->product_name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" cols="5" rows="2"
                                        placeholder="Enter description">{{ $product->description }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input name="price" type="text" class="form-control" id="harga"
                                        placeholder="Enter Harga" autocomplete="off" value="{{ $product->price }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input name="stock" type="text" class="form-control" id="stok"
                                        placeholder="Enter Stok" autocomplete="off" value="{{ $product->stock }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input name="product_code" type="text" class="form-control" id="kode_produk"
                                        placeholder="Enter Kode Produk" autocomplete="off"
                                        value="{{ $product->product_code }}">
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
                                <div class="col-md-12 mb-3">
                                    <label for="gambar">Pilih gambar</label>
                                    <input type="file" class="form-control" name="product_image[]"
                                        id="gambar" accept="image/*" multiple value="{{$product->image}}" required>
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
