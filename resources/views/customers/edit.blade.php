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
                            <h3 class="card-title">Edit Customers</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="POST" action="{{ route('customers.update', $customer->id) }} ">
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
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Enter Name" autocomplete="off" value="{{ $customer->name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input name="phone_number" type="number" class="form-control" id="phone_number"
                                        placeholder="Enter Phone Number" autocomplete="off" value="{{ $customer->phone_number }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="text" class="form-control" id="email"
                                        placeholder="Enter Email" autocomplete="off" value="{{ $customer->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="5" rows="2" placeholder="Enter Address">{{ $customer->address }}</textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-secondary">Submit</button>
                                <a href="{{ route('customers') }}" class="btn btn-danger">Cancel</a>
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
