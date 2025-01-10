<div style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333;">
    <h1 style="font-size: 24px; font-weight: bold; color: #333;">Kode Verifikasi 2FA</h1>

    <p>Halo, <strong>{{ $user->name }}</strong> 👋</p>

    <p>Kode verifikasi Two-Factor Authentication (2FA) Anda adalah:</p>

    <div
        style="background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; border-radius: 5px; text-align: center;">
        <strong style="font-size: 24px; color: #000;">{{ $user->two_factor_code }}</strong>
    </div>

    <p style="margin-top: 20px; font-size: 14px; color: #555;">
        Kode ini berlaku selama <strong>10 menit</strong>. Jika Anda tidak meminta kode ini, abaikan email ini.
    </p>



    <p style="margin-top: 20px;">Terima kasih,<br>@IKSASS</p>
</div>
