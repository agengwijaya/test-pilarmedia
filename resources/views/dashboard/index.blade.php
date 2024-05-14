@extends('layouts.main')
@section('content')
  <style>
    .highcharts-figure,
    .highcharts-data-table table {
      min-width: 310px;
      max-width: 800px;
      margin: 1em auto;
    }

    #container {
      height: 400px;
    }

    .highcharts-data-table table {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #ebebeb;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    .highcharts-data-table th {
      font-weight: 600;
      padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
      padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }
  </style>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <form action="{{ url('dashboard') }}" method="get">
          <div class="row">
            <div class="col-4">
              <div class="mb-3 mt-2">
                <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="{{ $tgl_awal }}" onchange="this.form.submit()">
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3 mt-2">
                <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="{{ $tgl_akhir }}" onchange="this.form.submit()">
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Transaksi Penjualan</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nama Sales</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Total Penjualan</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $produk = DB::table('products')->where('soft_delete', 0)->get();
                  @endphp
                  @foreach ($penjualan_sales as $item)
                    @foreach ($produk as $value)
                      @php
                        $sales = DB::table('sales')
                            ->where('sales_person_id', $item->id)
                            ->where('products_id', $value->id)
                            ->whereBetween('tanggal_transaksi', [$tgl_awal, $tgl_akhir])
                            ->sum('sales_amount');
                        // $sales = $item->sales->where('products_id', )->sum('sales_amount');
                      @endphp
                      <tr>
                        <th>{{ $item->nama }}</th>
                        <td>{{ $value->nama }}</td>
                        <td>Rp {{ number_format($sales, 0, ',', '.') }}</td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          {{ $penjualan_sales->links() }}
        </div>

      </div>

      <div class="col-lg-6">

        <div class="row">
          <div class="col-4">
            <div class="mb-3 mt-2">
              <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
              <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="{{ $tgl_awal }}">
            </div>
          </div>
          <div class="col-4">
            <div class="mb-3 mt-2">
              <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
              <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="{{ $tgl_akhir }}">
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Grafik Penjualan</h5>
              <figure class="highcharts-figure">
                <div id="container"></div>
              </figure>
            </div>
          </div>

        </div>
      </div>
  </section>

  <script>
    Highcharts.chart('container', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Transaksi Penjualan Sales',
        align: 'left'
      },
      // subtitle: {
      //   text: 'Source: <a target="_blank" ' +
      //     'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
      //   align: 'left'
      // },
      xAxis: {
        categories: [
          <?php foreach ($penjualan_sales as $value): ?> "{{ $value->nama }}",
          <?php endforeach; ?>
        ],
        crosshair: true,
        accessibility: {
          description: 'Countries'
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: ''
        }
      },
      tooltip: {
        valueSuffix: ' (1000 MT)'
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [
        <?php foreach ($penjualan_sales as $value): ?> {
          name: "{{ $value->nama }}",
          data: [
            <?php foreach ($produk as $val): ?>
            <?php $sales = DB::table('sales')
                ->where('sales_person_id', $item->id)
                ->where('products_id', $val->id)
                ->whereBetween('tanggal_transaksi', [$tgl_awal, $tgl_akhir])
                ->sum('sales_amount'); ?>
            {{ $sales }},
            <?php endforeach; ?>
          ]
        },
        <?php endforeach; ?>
      ]
    });
  </script>
@endsection
