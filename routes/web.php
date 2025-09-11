<?php

use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

// Form sayfası
Route::get('/', function () {
    return view('cv-form');
})->name('cv.form');

// Form submit route
Route::post('/cv_save', [CvController::class, 'store'])->name('cv.save');

// CV detay sayfası (fotoğraf ve bilgileri göstermek için)
Route::get('/cv/{id}', [CvController::class, 'show'])->name('cv.show');
