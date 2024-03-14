@extends('layouts.app_admin')
@section('action')
@section('title', 'Transaksi User')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Pengajuan Peminjaman</h1>
      <br>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Pengajuan Peminjaman</h5>
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <!-- Vertical Form -->
            <form class="row g-3" action="{{ route('insert-pengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                              <!-- Nama Peminjam (otomatis sesuai akun yang login) -->
                            <div class="form-group d-none" >
                                <label for="nama_peminjam">Nama Peminjam</label>
                                <input type="text" name="id_userlog" id="id_userlog" class="form-control" value="{{ Auth::user()->id}}" readonly>
                            </div>
                            <!-- Sarana (pilihan dengan dropdown select) -->
                            <div class="form-group">
                              <label for="id_dbsarana">Sarana</label>
                              <select class="form-select" name="id_dbsarana" id="id_dbsarana" >
                                  <option value="" selected disabled>Pilih Sarana</option>
                                  @foreach($dbsaranas as $dbsarana)
                                      <option value="{{ $dbsarana->id }}" data-jumlah="{{ $dbsarana->jumlah_sarana }}">
                                          {{ $dbsarana->nama_sarana }}
                                      </option>
                                  @endforeach
                              </select>
                            </div>


                            <!-- Tempatkan ini di sekitar setiap input yang ingin Anda validasi -->
                            <div class="form-group">
                              <label for="jumlah">Jumlah Sarana</label>
                              <input type="number" name="jumlah" class="form-control" id="jumlah">
                          </div>

                            {{-- <script>
                              // Menggunakan JavaScript untuk mengatur jumlah_sarana berdasarkan pilihan sarana
                              document.getElementById('id_dbsarana').addEventListener('change', function() {
                                  var selectedOption = this.options[this.selectedIndex];
                                  var maxJumlah = parseInt(selectedOption.getAttribute('data-jumlah'));
                                  
                                  // Reset nilai jika melebihi jumlah yang tersedia
                                  var jumlahSaranaInput = document.getElementById('jumlah');
                                  if (parseInt(jumlahSaranaInput.value) > maxJumlah) {
                                      jumlahSaranaInput.value = '';
                                  }
                                  jumlahSaranaInput.max = maxJumlah;
                                  jumlahSaranaInput.readOnly = false;
                              });
                          
                              // Validasi jumlah sarana saat form disubmit
                              document.querySelector('form').addEventListener('submit', function(event) {
                                  var selectedOption = document.getElementById('id_dbsarana').options[document.getElementById('id_dbsarana').selectedIndex];
                                  var maxJumlah = parseInt(selectedOption.getAttribute('data-jumlah'));
                                  var jumlahSaranaInput = document.getElementById('jumlah');
                          
                                  if (parseInt(jumlahSaranaInput.value) > maxJumlah) {
                                      alert('Jumlah sarana melebihi yang tersedia!');
                                      event.preventDefault(); // Mencegah pengajuan formulir
                                  }
                              });
                          </script> --}}

                            <!-- Tanggal Pinjam -->
                            <div class="form-group">
                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" >
                            </div>

                            <!-- Tanggal Kembali -->
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" >
                            </div>
                            <!-- Keterangan -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3" ></textarea>
                            </div>

                            <!-- Status (otomatis belum terkonfirmasi) -->
                            <div class="form-group d-none">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" value="DALAM-PROSES" readonly>
                            </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div> 
              </form><!-- Vertical Form --> 

            </div>
          </div>
      </div>
    </section>
    <script>
      window.onload = function() {
        // Mendapatkan elemen input tanggal mulai
        var startDateInput = document.getElementById("tanggal_pinjam");
        
        // Mendapatkan elemen input tanggal selesai
        var endDateInput = document.getElementById("tanggal_kembali");
        
        // Mendapatkan tanggal saat ini
        var today = new Date();
        
        // Menambahkan 1 hari ke tanggal saat ini
        var minDate = new Date(today);
        minDate.setDate(today.getDate() + 1);
        
        // Mengubah format tanggal menjadi YYYY-MM-DD (sesuai format input type date)
        var minDateFormatted = minDate.toISOString().slice(0, 10);
        
        // Mengatur atribut min pada input tanggal mulai
        startDateInput.min = minDateFormatted;
        
        // Mengatur atribut min pada input tanggal selesai
        endDateInput.min = minDateFormatted;
      }
  </script>
  </main><!-- End #main -->

