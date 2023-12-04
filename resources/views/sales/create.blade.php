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
                            <h3 class="card-title">Add Sales</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('sales.store') }}">
                            @csrf
                            <div class="card-body row">
                                <div class="col-md-6 mb-3">
                                    <label for="trx_date">Transaction Date</label>
                                    <input type="date" class="form-control @error('trx_date') is-invalid @enderror"
                                        name="trx_date" value="{{ old('trx_date') }}">
                                    @error('trx_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sub_amount">Subtotal Amount</label>
                                    <input type="number" class="form-control @error('sub_amount') is-invalid @enderror"
                                        name="sub_amount" value="{{ old('sub_amount') }}">
                                    @error('sub_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="amount_total">Amount Total</label>
                                    <input type="number" class="form-control @error('amount_total') is-invalid @enderror"
                                        name="amount_total" value="{{ old('amount_total') }}">
                                    @error('amount_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="total_products">Total Product</label>
                                    <input type="number" class="form-control @error('total_products') is-invalid @enderror"
                                        name="total_products" value="{{ old('total_products') }}">
                                    @error('total_products')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customer_id">Customer Name</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror"
                                        name="customer_id">
                                        <option value="" disabled selected>Chosen Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('sales') }}" class="btn btn-danger">Cancel</a>
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
