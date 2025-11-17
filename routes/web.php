<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

// ======== Dashboard + Auth ========
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD anggota
    Route::resource('anggota', AnggotaController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('golongan', GolonganController::class);

    Route::post('kegiatan/{kegiatan}/peserta', [KegiatanController::class, 'addParticipant'])->name('kegiatan.addParticipant');
    Route::delete('kegiatan/{kegiatan}/peserta/{anggota}', [KegiatanController::class, 'removeParticipant'])->name('kegiatan.removeParticipant');
    Route::get('kegiatan/{kegiatan}/peserta', [KegiatanController::class, 'manageParticipants'])->name('kegiatan.manageParticipants');
// Profile
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

// export
Route::get('export/anggota/excel', [ExportController::class, 'exportAnggotaExcel'])->name('export.anggota.excel');
Route::get('export/kegiatan/pdf', [ExportController::class, 'exportKegiatanPdf'])->name('export.kegiatan.pdf');

// =============== OTP ===============
Route::get('/verify-otp', [OtpVerificationController::class, 'showForm'])->name('verify.otp.form');
Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('verify.otp');
Route::post('/resend-otp', [OtpVerificationController::class, 'resend'])->name('verification.otp.resend');

// =============== Forgot / Reset Password ===============
Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
    ->middleware('guest')->name('password.request');

Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
    ->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
    ->middleware('guest')->name('password.reset');

Route::post('/reset-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
    ->middleware('guest')->name('password.store');

// =============== LOGOUT ===============
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update-password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.update.password');
    Route::post('/settings/update-photo', [\App\Http\Controllers\SettingsController::class, 'updatePhoto'])->name('settings.update.photo');
});

require __DIR__ . '/auth.php';
