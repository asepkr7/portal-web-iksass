<?php

namespace App\Http\Controllers;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Generate kode 2FA baru jika tidak ada atau sudah expired
            if (!$user->two_factor_code || now()->greaterThan($user->two_factor_expires_at)) {
                $this->generateTwoFactorCode($user);
            }

            session(['two_factor_user_id' => $user->id]);

            return redirect()->route('2fa.verify')->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
        }

        return back()->with('loginError', 'Email atau password salah.');
    }

    // Generate dan kirim kode 2FA
    public function generateTwoFactorCode($user)
    {
        $user->two_factor_code = rand(100000, 999999);
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        // Kirim email
        Mail::to($user->email)->send(new TwoFactorCodeMail($user));
    }

    // Reset Kode 2FA
    public function resendTwoFactorCode()
    {
        $user = User::find(session('two_factor_user_id'));

        if ($user) {
            $this->generateTwoFactorCode($user);
            return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
        }

        return redirect()->route('login')->with('loginError', 'Session tidak valid.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}