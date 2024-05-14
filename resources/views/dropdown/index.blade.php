@extends('layouts.main')
@section('content')
  <div class="pagetitle">
    <h1>Dependent Dropdown</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dependent Dropdown</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Wilayah Indonesia</h5>
            <div class="mb-3">
              <label for="provinsi" class="form-label">Provinsi</label>
              <select class="form-select" aria-label="Default select example" id="provinsi">
                <option selected>pilih</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="kabupaten" class="form-label">Kabupaten</label>
              <select class="form-select" aria-label="Default select example" id="kabupaten">
                <option selected>pilih</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="kecamatan" class="form-label">Kecamatan</label>
              <select class="form-select" aria-label="Default select example" id="kecamatan">
                <option selected>pilih</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="kelurahan" class="form-label">Kelurahan</label>
              <select class="form-select" aria-label="Default select example" id="kelurahan">
                <option selected>pilih</option>
              </select>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script>
    $(function() {
      wilayah('#provinsi', 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    })

    $('#provinsi').on('change', function() {
      let val = $(this).val();

      $('#kabupaten option').remove();
      $('#kecamatan option').remove();
      $('#kelurahan option').remove();
      wilayah('#kabupaten', `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${val}.json`)
    })

    $('#kabupaten').on('change', function() {
      let val = $(this).val();
      $('#kecamatan option').remove();
      $('#kelurahan option').remove();
      wilayah('#kecamatan', `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${val}.json`)
    })

    $('#kecamatan').on('change', function() {
      let val = $(this).val();

      $('#kelurahan option').remove();
      wilayah('#kelurahan', `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${val}.json`)
    })

    function wilayah(input_id, url) {
      $.ajax({
        type: "GET",
        url: url,
        success: function(res) {
          $(input_id).append(`<option selected>pilih</option>`);
          res.forEach(element => {
            $(input_id).append(`<option value="${element.id}">${element.name}</option>`);
          });
        }
      })
    }
  </script>
@endsection
