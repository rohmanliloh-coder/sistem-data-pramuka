<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Verifikasi OTP</h2>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="otp" :value="__('Masukkan Kode OTP')" />
                <x-text-input id="otp" name="otp" type="text"
                    class="block mt-1 w-full text-center tracking-[10px]" maxlength="6" required autofocus />
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Verifikasi Sekarang') }}
            </x-primary-button>
        </form>

        <div class="text-center mt-4">
            <button id="resend-btn" class="text-sm text-blue-600 disabled:text-gray-400" disabled
                onclick="document.getElementById('resend-form').submit()">
                Kirim ulang OTP (60)
            </button>

            <form id="resend-form" action="{{ route('verification.otp.resend') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="email" value="{{ old('email') }}">
            </form>
        </div>
    </div>
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', () => {
            Swal.fire({
                title: 'Memverifikasi...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    </script>

    <script>
        let timeLeft = 60;
        const resendBtn = document.getElementById('resend-btn');
        const timer = setInterval(() => {
            timeLeft--;
            resendBtn.textContent = `Kirim ulang OTP (${timeLeft})`;
            if (timeLeft <= 0) {
                clearInterval(timer);
                resendBtn.textContent = 'Kirim ulang OTP';
                resendBtn.disabled = false;
            }
        }, 1000);
    </script>

</x-guest-layout>
