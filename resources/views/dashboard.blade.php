@extends('pages.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalProducts }}</h3>

                            <p>Jumlah Semua Produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalCategories }}</h3>

                            <p>Jumlah Kategori Produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format($totalPrice, 0, ',', '.') }}</h3>

                            <p>Jumlah total harga produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalStock }}</h3>

                            <p>Jumlah Stok semua produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Column Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart" id="produk-column-chart-container" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Pie Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart" id="harga-pie-chart-container" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pie Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart" id="stok-Pie-chart-container" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categories = @json($categories);


            var columnChartData = categories.map(function(category) {
                return {
                    name: category.name,
                    y: category.products_count
                };
            });

            // Highcharts - Produk per kategori Column Chart
            Highcharts.chart('produk-column-chart-container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Produk per Kategori'
                },
                xAxis: {
                    categories: @json($categories->pluck('category_name')),
                    title: {
                        text: 'Kategori'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Produk'
                    }
                },
                series: [{
                    name: 'Jumlah Produk',
                    data: columnChartData
                }]
            });

            // Highcharts - Harga produk per kategori Pie Chart
            Highcharts.chart('harga-pie-chart-container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Jumlah Harga produk per Kategori'
                },
                series: [{
                    name: 'Total Price',
                    colorByPoint: true,
                    data: @json($chartDataPrice),
                }],
            });

            // Highcharts - Stok per kategori Pie Chart
            Highcharts.chart('stok-Pie-chart-container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Jumlah Stok produk per Kategori'
                },
                series: [{
                    name: 'Total Stock',
                    colorByPoint: true,
                    data: @json($chartDataStock),
                }],
            });



        });
    </script>
    <!-- /.content -->
@endsection
