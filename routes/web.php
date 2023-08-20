<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\CvController;



Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/cvs', 'App\Http\Controllers\CvController@index')->name('cv.index');
Route::get('/cvs/create', 'App\Http\Controllers\CvController@create')->name('cv.create');
Route::post('/cvs', 'App\Http\Controllers\CvController@store')->name('cv.store');


// Report Generation Routes
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate');

