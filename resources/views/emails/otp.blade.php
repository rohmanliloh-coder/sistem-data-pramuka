@component('mail::message')
# Verifikasi Akun Anda

Halo! Berikut adalah kode OTP untuk verifikasi akun Anda:

@component('mail::panel')
{{ $otp }}
@endcomponent

Kode ini berlaku selama 10 menit.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
