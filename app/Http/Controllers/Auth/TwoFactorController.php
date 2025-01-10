<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function showVerifyForm()
    {
        return view('Auth.verify-2fa', ['title' => '2FA']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = User::find(session('two_factor_user_id'));

        if (!$user) {
            return redirect()->route('login')->with('error', 'Session tidak valid.');
        }

        if ($user->two_factor_code == $request->code && now()->lessThan($user->two_factor_expires_at)) {
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
            $user->save();

            Auth::login($user);
            session()->forget('two_factor_user_id');

            return redirect()->route('dashboard')->with('success', '2FA berhasil diverifikasi.');
        }

        return back()->with('error', 'Kode verifikasi tidak valid.');
    }
}