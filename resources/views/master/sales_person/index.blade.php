@extends('layouts.main')
@section('content')
  <div class="pagetitle">
    <h1>Sales Person</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Sales Person</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Sales Person</h5>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd">
              Tambah Sales Person
            </button>
            <table class="table" id="transaksi">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sales_person as $item)
                  <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td class="">
                      <button class="btn btn-danger btn-xs" id="btn_delete" data-bs-target="#modalDeleteConfirm" data-bs-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                      <button class="btn btn-warning btn-xs" id="btn_edit" data-bs-target="#modalEdit" data-bs-toggle="modal" data-data='{{ $item }}'><i class="fa fa-pencil"></i></button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('sales-person') }}" method="post">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddLabel">Tambah Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">No HP</label>
              <input type="number" class="form-control" id="no_hp" name="no_hp">
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea type="text" rows="5" class="form-control" id="alamat" name="alamat"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" id="form_edit">
          @method('put')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Edit Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama_edit" name="nama">
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">No HP</label>
              <input type="number" class="form-control" id="no_hp_edit" name="no_hp">
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea type="text" rows="5" class="form-control" id="alamat_edit" name="alamat"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(function() {
      let table = $('#transaksi').DataTable({});

      $('#transaksi').on('click', 'tbody td #btn_edit', function() {
        let data = $(this).data('data');
        $('#form_edit').attr('action', "{{ url('sales-person/') }}" + '/' + data.id);
        $('#nama_edit').val(data.nama);
        $('#no_hp_edit').val(data.no_hp);
        $('#alamat_edit').val(data.alamat);
      })

      $('#transaksi').on('click', 'tbody td #btn_delete', function() {
        let id = $(this).attr('data-id');
        $('#form_delete').attr('action', "{{ url('sales-person/') }}" + '/' + id);
      })
    })
  </script>
@endsection
