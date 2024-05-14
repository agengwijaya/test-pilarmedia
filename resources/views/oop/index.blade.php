@extends('layouts.main')
@section('content')
  <div class="pagetitle">
    <h1>OOP</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">OOP</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contoh Hasil OOP dari Konsep Encapsulation, Inheritance, Polimorphism</h5>
            <p>{{ $buku }}</p>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
