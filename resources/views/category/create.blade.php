@extends('pages.main')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route("category.store")}}">
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
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input name="category_name" type="text" class="form-control" id="name"
                            placeholder="Enter Name" autocomplete="off">
                    </div>

                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('category') }}" class="btn btn-danger">Cancel</a>
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
