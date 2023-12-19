@extends('home.main')

@section('content')
    <!-- Product section-->
    <section class="py-5 mt-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    @if ($product->image)
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset(json_decode($product->image)[0]) }}" alt="{{ $product->product_name }}" />
                    @else
                        No Image
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">{{$product->product_code}}</div>
                    <h1 class="display-5 fw-bolder">{{$product->product_name}}</h1>
                    <div class="fs-5 mb-5">
                        <span>{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <p class="lead">{{$product->description}}</p>
                    <div class="d-flex">
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Pesan : 0896-7656-0608
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
