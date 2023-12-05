@extends('home.main')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">
                <div class="col-xl-6">
                    <h1>Toy Shop</h1>
                    <h2>Selamat datang di rumah kami, Temukan berbagai macam mainan yang memikat</h2>
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch">
                        <div class="content">
                            <h3>About Us</h3>
                            <p>
                                Kenali kami lebih dekat! Di sini, Anda akan menemukan cerita tentang perjalanan kami, visi,
                                dan misi untuk menyediakan mainan berkualitas tinggi yang menginspirasi dan mendukung
                                perkembangan anak-anak.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-7 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="bi bi-fire"></i>
                                    <h4>Action Figure</h4>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-dice-4"></i>
                                    <h4>Papan Permainan</h4>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-tencent-qq"></i>
                                    <h4>Boneka</h4>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-mortarboard"></i>
                                    <h4>Mainan Edukasi</h4>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->


        <!-- ======= Product Section ======= -->
        <section id="products" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Products</h2>
                    <p>Jelajahi koleksi mainan unik dan menarik kami. Dari mainan edukatif hingga mainan kreatif, setiap
                        produk kami dirancang dengan cermat untuk memberikan pengalaman bermain yang tak terlupakan.</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            @php
                                $categories = ['Action Figure', 'Papan Permainan', 'Boneka', 'Mainan Edukasi'];
                            @endphp

                            @foreach ($categories as $index => $category)
                                <li data-filter=".filter-{{ $index + 1 }}">{{ $category }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $product->category_id }}">
                            <div class="portfolio-wrap">
                                @if ($product->image)
                                    <img src="{{ asset(json_decode($product->image)[0]) }}" class="img-fluid"
                                        alt="{{ $product->product_name }}">
                                @else
                                    No Image
                                @endif
                                <div class="portfolio-info">
                                    <h4>{{ $product->product_name }}</h4>
                                    <p>Category {{ $product->category_name }}</p>
                                    <div class="portfolio-links">
                                        {{-- <a href="{{ asset('/' . $product->image) }}" data-gallery="portfolioGallery"
                                            class="portfolio-lightbox" title="{{ $product->product_name }}"><i
                                                class="bx bx-plus"></i></a> --}}



                                        <a href="#" title="More Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Product Section -->


    </main><!-- End #main -->
@endsection
