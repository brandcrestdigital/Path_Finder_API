<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\WebinarController;
use App\Services\Messenger360Service;
use Illuminate\Support\Facades\Route;

Route::get('/mail-test', function () {
    try {
        Mail::raw('Mail Working', function ($message) {
            $message->to('sk.asif0490@gmail.com')
                ->subject('SMTP Test');
        });

        return 'Mail Sent Successfully';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::get('/test-whatsapp/{phone}', function (Messenger360Service $whatsapp, $phone) {

    $text = 'Hello 👋 This is a test message from BCD.';

    try {
        $response = $whatsapp->send($phone, $text);

        return response()->json([
            'success' => true,
            'data'    => $response,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::prefix('auth')->group(function () {

    // ================= AUTH =================

    Route::post('admin-register', [AuthController::class, 'admin_register']);
    Route::post('admin-login', [AuthController::class, 'admin_login']);

    // Route::post('user-register', [AuthController::class, 'register']);
    // Route::post('user-login', [AuthController::class, 'login']);

    // // Login with Orginazation
    // Route::post('org-login', [AuthController::class, 'org_login']);

    // // ================= PASSWORD / OTP =================
    // Route::post('forgot-password', [AuthController::class, 'sendOtp']);
    // Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    // Route::post('reset-password', [AuthController::class, 'resetPassword']);

    // Route::post('organization/forgot-password', [AuthController::class, 'OrgsendOtp']);

    // // ================= GOOGLE OAUTH =================
    // Route::get('google/redirect', [AuthController::class, 'redirectToGoogle']);
    // Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);

});

Route::prefix('admin')->middleware(['api', 'jwt.auth'])->group(function () {
    Route::get('/auth/me', [GoogleController::class, 'me']);
    Route::post('/create-webinars', [WebinarController::class, 'store']);
    Route::get('/list-webinars', [WebinarController::class, 'index']);
    Route::get('/list-webinars/{slug}', [WebinarController::class, 'show']);     // Edit - Get data
    Route::put('/update-webinars/{slug}', [WebinarController::class, 'update']); // Update
    Route::delete('/delete-webinars/{slug}', [WebinarController::class, 'destroy']);
    Route::get('/webinars/registrations', [WebinarController::class, 'registrations']);
    Route::get('/webinars/{webinarId}/registrations', [WebinarController::class, 'getRegistrationsByWebinar']);
    Route::post('/applications/{applicationId}/attendance', [WebinarController::class, 'markAttendance']);

    Route::post('/applications/{id}/approve', [ApplicationController::class, 'approve']);
    Route::post('/applications/{id}/reject', [ApplicationController::class, 'reject']);
    
});

Route::prefix('applicants')->group(function () {
    Route::post('/register', [ApplicationController::class, 'store']);
    Route::get('/webinars/by-date', [ApplicationController::class, 'getByDate']);
});

// pending 1 mail, 2 meeting link creation while webinar