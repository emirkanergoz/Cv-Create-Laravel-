<?php

use App\Http\Controllers\CvController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CvController as AdminCvController;

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
        return redirect()->route('admin.dashboard');
    }
    return view('admin.templates.login');
});
// Eski önizleme rotasını korumak yerine asıl korumalı dashboard'a yönlendir
Route::get('/admin/dashboard-template', function () {
    return redirect()->route('admin.dashboard');
});

// Registration disabled

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

    // Admin-only login
    $selectedRole = $request->input('login_role'); // 'user' | 'admin'
    $userRole = $user->getAttribute('role');
    if ($userRole !== 'admin' || ($selectedRole && $selectedRole !== 'admin')) {
        return back()->withErrors(['email' => 'Only admins can log in.'])->onlyInput('email');
    }

    Auth::login($user, $remember);
    $request->session()->regenerate();
    // Admin dashboard
    return redirect()->intended(route('admin.dashboard'));
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

// Admin dashboard (korumalı basit kontrol)
Route::get('/admin/dashboard', function () {
    if (!Auth::check() || Auth::user()->getAttribute('role') !== 'admin') {
        abort(403);
    }
    return view('admin.templates.dashboard');
})->name('admin.dashboard');

// Admin: CV management
Route::prefix('admin')->group(function () {
    Route::get('/cvs', [AdminCvController::class, 'index'])->name('admin.cvs.index');
    Route::get('/cvs/{cv}/edit', [AdminCvController::class, 'edit'])->name('admin.cvs.edit');
    Route::put('/cvs/{cv}', [AdminCvController::class, 'update'])->name('admin.cvs.update');
    Route::delete('/cvs/{cv}', [AdminCvController::class, 'destroy'])->name('admin.cvs.destroy');
});
