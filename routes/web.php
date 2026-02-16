<?php

use App\Http\Controllers\FinancialReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FinancialReportController::class, 'index'])->name('reports.home');
Route::get('/reports/download', [FinancialReportController::class, 'download'])->name('reports.download');
