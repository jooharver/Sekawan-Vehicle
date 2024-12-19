<?php

use App\Exports\UsageLogExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsageLogController;


Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/usagelog/export-pdf', [UsageLogController::class, 'exportPDF'])->name('export-usagelog');
Route::get('/export-usage', function () {
    return Excel::download(new UsageLogExport(), 'usage_data.xlsx');
})->name('export-usage');


