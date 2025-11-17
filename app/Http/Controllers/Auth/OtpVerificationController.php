<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.verify-otp');
    }

    // 🔹 Proses verifikasi OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $otpRecord = Otp::where('otp_code', $request->otp)->first();

        if (! $otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // Cek apakah OTP sudah kadaluarsa
        if ($otpRecord->isExpired()) {
            $otpRecord->delete();
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa, silakan kirim ulang.']);
        }

        // Ambil user terkait
        $user = $otpRecord->user;
        if (! $user) {
            return back()->withErrors(['otp' => 'User tidak ditemukan untuk OTP ini.']);
        }

        // Tandai user sebagai terverifikasi
        $user->update(['is_verified' => true]);

        // Hapus OTP agar tidak bisa dipakai ulang
        $otpRecord->delete();

        return redirect()->route('login')->with('status', 'Akun berhasil diverifikasi! Silakan login.');
    }

    // 🔹 Kirim ulang OTP
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otpRecord = Otp::where('otp_code', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (! $otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau kadaluarsa.']);
        }

        $user = User::find($otpRecord->user_id);

        $user->update([
            'is_verified'       => true,
            'email_verified_at' => now(),
        ]);

        $otpRecord->delete();

        return redirect()->route('login')->with('status', 'Verifikasi berhasil! Silakan login.');

    }
}
