<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    // Authentication...
    if ($enableViews) {
        Route::get('/giris-yap', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest'])
            ->name('login');
    }

    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');

    Route::post('/giris-yap', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest',
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post('/cikis-yap', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {
            Route::get('/sifremi-unuttum', [PasswordResetLinkController::class, 'create'])
                ->middleware(['guest'])
                ->name('password.request');

            Route::get('/sifre-sifirla/{token}', [NewPasswordController::class, 'create'])
                ->middleware(['guest'])
                ->name('password.reset');
        }

        Route::post('/sifremi-unuttum', [PasswordResetLinkController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.email');

        Route::post('/sifre-sifirla', [NewPasswordController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::get('/kaydol', [RegisteredUserController::class, 'create'])
                ->middleware(['guest'])
                ->name('register');
        }

        Route::post('/kaydol', [RegisteredUserController::class, 'store'])
            ->middleware(['guest']);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        if ($enableViews) {
            Route::get('/eposta/onay', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware(['auth'])
                ->name('verification.notice');
        }

        Route::get('/eposta/onay/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/eposta/onay-bildirimi', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/u/profil-ayarlari', [ProfileInformationController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/u/sifre', [PasswordController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-password.update');
    }

    // Password Confirmation...
    if ($enableViews) {
        Route::get('/u/sifreyi-onayla', [ConfirmablePasswordController::class, 'show'])
            ->middleware(['auth'])
            ->name('password.confirm');

        Route::get('/u/dogrulanmis-sifre-durumu', [ConfirmedPasswordStatusController::class, 'show'])
            ->middleware(['auth'])
            ->name('password.confirmation');
    }

    Route::post('/u/sifreyi-onayla', [ConfirmablePasswordController::class, 'store'])
        ->middleware(['auth']);

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {
        if ($enableViews) {
            Route::get('/iki-faktor-dogrulama', [TwoFactorAuthenticatedSessionController::class, 'create'])
                ->middleware(['guest'])
                ->name('two-factor.login');
        }

        Route::post('/iki-faktor-dogrulama', [TwoFactorAuthenticatedSessionController::class, 'store'])
            ->middleware(array_filter([
                'guest',
                $twoFactorLimiter ? 'throttle:'.$twoFactorLimiter : null,
            ]));

        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
            ? ['auth', 'password.confirm']
            : ['auth'];

        Route::post('/u/iki-faktor-dogrulama', [TwoFactorAuthenticationController::class, 'store'])
            ->middleware($twoFactorMiddleware);

        Route::delete('/u/iki-faktor-dogrulama', [TwoFactorAuthenticationController::class, 'destroy'])
            ->middleware($twoFactorMiddleware);

        Route::get('/u/iki-faktor-qr', [TwoFactorQrCodeController::class, 'show'])
            ->middleware($twoFactorMiddleware);

        Route::get('/u/iki-faktor-kurtarma-kodu', [RecoveryCodeController::class, 'index'])
            ->middleware($twoFactorMiddleware);

        Route::post('/u/iki-faktor-kurtarma-kodu', [RecoveryCodeController::class, 'store'])
            ->middleware($twoFactorMiddleware);
    }
});
