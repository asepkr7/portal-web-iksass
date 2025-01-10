<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Authentication (2FA)</title>
    <link rel="icon" href="/img/logo1.png">
    <!-- General CSS Files -->

    <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="/template/assets/css/style.css">
  <link rel="stylesheet" href="/template/assets/css/components.css">
</head>

<body>
<div id="app">
<div class="section">
    <div class="section-header">
        <h1>Verifikasi Two-Factor Authentication (2FA)</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Masukkan Kode Verifikasi</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> @endif

                    <form method="POST"
        action="{{ route('2fa.verify.post') }}">
    @csrf
    <div class="form-group">
        <label for="code">Kode Verifikasi</label>
        <input type="text" name="code" class="form-control" placeholder="Masukkan kode 6 digit" required
            autofocus>
    </div>
    <button type="submit" class="btn btn-success btn-block">Verifikasi</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('2fa.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link btn-block">Kirim Ulang Kode</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="/template/assets/js/scripts.js"></script>
    <script src="/template/assets/js/custom.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <!-- Page Specific JS File -->
    </body>

</html>
