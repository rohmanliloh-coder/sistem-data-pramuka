<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],

            // USERNAME RULES
            'username' => [
                'required',
                'string',
                'min:4',
                'max:20',
                'regex:/^(?=.{4,20}$)(?!.*__)[A-Za-z][A-Za-z0-9_]*$/',
                'unique:users,username',
            ],

            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],

            // PHONE RULES
            'phone'    => [
                'required',
                'string',
                'regex:/^\+?[0-9]{9,15}$/',
            ],

            // PASSWORD KUAT
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(10)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'username.regex' => 'Username harus 4–20 karakter, diawali huruf, tanpa "__".',
            'phone.regex'    => 'Nomor telepon tidak valid, gunakan format +62xxxx atau 08xxxx.',
        ]);

        // Fallback (case-insensitive check)
        if (\App\Models\User::whereRaw('LOWER(username) = ?', [strtolower($request->username)])->exists()) {
            return back()->withErrors(['username' => 'Username sudah digunakan.'])->withInput();
        }

        // Simpan user
        $user = \App\Models\User::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'password'    => Hash::make($request->password),
            'is_verified' => false,
        ]);

        // OTP
        $otpCode = rand(100000, 999999);

        Otp::create([
            'user_id'    => $user->id,
            'otp_code'   => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new SendOtpMail($user, $otpCode));

        session(['otp_email' => $user->email]);

        return redirect()->route('verify.otp.form')
            ->with('status', 'Kode OTP telah dikirim ke email Anda!');
    }

}
