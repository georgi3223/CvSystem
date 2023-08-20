<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CvController;

// Default route returning the main view
Route::get('/', function () {
    return view('layouts.app');
});

// CV Routes
Route::get('/cvs', 'App\Http\Controllers\CvController@index')->name('cv.index');
Route::get('/cvs/create', 'App\Http\Controllers\CvController@create')->name('cv.create');
Route::post('/cvs', 'App\Http\Controllers\CvController@store')->name('cv.store');

// Report Generation Routes
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate');

// University and Technology Routes
Route::post('/universities', 'UniversityController@store')->name('university.store');
Route::post('/technologies', 'TechnologyController@store')->name('technology.store');
