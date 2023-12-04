@extends('pages.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 mt-3">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Sales Detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('salesdetail.update' , ['id' => $sales_detail->id])}}">
                            @method('PUT')
                            @csrf
                            <div class="card-body row">
                                <div class="col-md-6 mb-3">
                                    <label for="sales_id">Code sales</label>
                                    <select class="form-control @error('sales_id') is-invalid @enderror"
                                        name="sales_id">
                                        <option value="" disabled selected>Chosen Code sales</option>
                                        @foreach ($sales as $id => $code_sale)
                                            <option value="{{ $id }}"
                                                {{ old('sales_id', $sales_detail->sales_id) == $id ? 'selected' : '' }}>
                                                {{ $code_sale }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sales_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="product_id">Product Name</label>
                                    <select class="form-control @error('product_id') is-invalid @enderror"
                                        name="product_id">
                                        <option value="" disabled selected>Chosen Product Name</option>
                                        @foreach ($products as $id => $product_name)
                                            <option value="{{ $id }}"
                                                {{ old('product_id', $sales_detail->product_id) == $id ? 'selected' : '' }}>
                                                {{ $product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        name="quantity" value="{{ old('quantity', $sales_detail->quantity) }}">
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('salesdetail') }}" class="btn btn-danger">Cancel</a>
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
