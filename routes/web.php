<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CvController;

// Default route returning the main view
Route::get('/', function () {
    return view('layouts.app');
});

// CV Routes
Route::get('/cvs', [CvController::class, 'index'])->name('cv.index');
Route::get('/cvs/create', [CvController::class, 'create'])->name('cv.create');
Route::post('/cvs', [CvController::class, 'store'])->name('cv.store');

// Report Generation Routes
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate');

// University and Technology Routes
Route::post('/universities', [UniversityController::class, 'store'])->name('university.store');
Route::post('/technologies', [TechnologyController::class, 'store'])->name('technology.store');