<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi 2FA</title>
</head>

<body>
    <h2>Masukkan Kode 2FA</h2>

    <form method="POST" action="{{ route('2fa.verify.post') }}">
        @csrf
        <input type="text" name="code" placeholder="Kode Verifikasi" required>
        <button type="submit">Verifikasi</button>
    </form>

    <form method="POST" action="{{ route('2fa.resend') }}">
        @csrf
        <button type="submit">Kirim Ulang Kode</button>
    </form>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>

</html>
