<?php

use App\Http\Controllers\CvController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Form sayfası
Route::get('/', function () {
    return view('cv-form');
})->name('cv.form');

// Form submit route
Route::post('/cv_save', [CvController::class, 'store'])->name('cv.save');

// CV detay sayfası (fotoğraf ve bilgileri göstermek için)
Route::get('/cv/{id}', [CvController::class, 'show'])->name('cv.show');

Route::get('/cv/{id}/download', [CvController::class, 'downloadPdf'])->name('cv.download');

Route::get('/admin/login-template', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard-template');
    }
    return view('admin.templates.login');
});
Route::get('/admin/dashboard-template', function () {
    return view('admin.templates.dashboard');
});

// Minimal auth endpoint with clearer errors
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    $remember = (bool) $request->boolean('remember');

    $user = \App\Models\User::where('email', $data['email'])->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Kullanıcı bulunamadı.'])->onlyInput('email');
    }

    if (!Hash::check($data['password'], $user->password)) {
        return back()->withErrors(['email' => 'Şifre hatalı.'])->onlyInput('email');
    }

    Auth::login($user, $remember);
    $request->session()->regenerate();
    return redirect('/admin/dashboard-template');
})->name('login');

// Hızlı teşhis: oturum ve kullanıcıyı gör
Route::get('/whoami', function () {
    return [
        'auth' => Auth::check(),
        'user' => Auth::user(),
    ];
});

// routes/web.php
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/admin/login-template');
})->name('logout');
