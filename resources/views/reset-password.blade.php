<!DOCTYPE html>
<html lang="en">

<head  >
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIMPAN SARANA LOGIN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/vendor/bootsrap/css/bootstrap.min.css') }}">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SIMPANSARANA</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">SIMPANSARANA</h5>
                    <p class="text-center small">Anda melupakan password, silakan untuk melakukan reset password agar bisa masuk ke akun anda</p>
                  </div>

                  <!-- session flass saat halaman error -->
                  {{-- @if (Session::has('status'))
                  <div class="alert alert-danger" role="alert">
                    {{ Session::get('message') }}
                  </div>
                  @elseif (Session::has('ubahPassword'))
                  <div class="alert alert-success" role="alert">
                    {{ Session::get('ubahPassword') }}
                  </div>
                  @endif --}}


                  <form method="POST" action="{{ route('processResetPassword') }}" class="row g-3 needs-validation" novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ request()->email }}">
                    <div class="col-12">
                      <label for="password" class="form-label">Masukkan Password Baru</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Masukkan password baru.</div>
                    </div>
                    <div class="col-12">
                      <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                      <div class="invalid-feedback">Konfirmasi password baru.</div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                  <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <!-- Vendor JS Files -->
 <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
 <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
 <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

 <!-- Template Main JS File -->
 <script src="{{ asset('assets/js/main.js')}}"></script>
 <script src="{{ asset('assets/vendor/bootsrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
