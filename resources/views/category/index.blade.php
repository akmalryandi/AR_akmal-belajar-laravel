@extends('pages.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Category</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="search" method="get" action="{{ route('category') }}">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('category.create') }}" type="button" class="btn btn-primary mb-2"><i
                                    class="bi bi-plus-lg"></i></a>
                        @endif
                    </div>

                    <div class="me-1 bd-highlight">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search"
                            autocomplete="off">
                    </div>
                    <div class="bd-highlight">
                        <button type="submit" name="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <table id="example1" class="table table-bordered table-striped mb-3">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $data)
                        <tr>
                            <td>{{ $data->category_name }}</td>
                            <td>{{ $data->is_active }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td><a href="{{ route('category.edit', ['id' => $data->id]) }}"> <button
                                            class="btn btn-secondary m-2"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="{{ route('category.delete', ['id' => $data->id]) }}"> <button
                                            class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </table>

            {{-- Pagination --}}
            {{ $category->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
