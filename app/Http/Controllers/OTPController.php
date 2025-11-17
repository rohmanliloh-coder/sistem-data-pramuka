<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class OTPController extends Controller
{
    public function showForm(Request $request)
    {
        $email = session('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp_code != $request->otp || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.']);
        }

        $user->update([
            'is_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        return redirect()->route('login')->with('status', 'Akun berhasil diverifikasi! Silakan login.');
    }
}

