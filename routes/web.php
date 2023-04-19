<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/clients', [ClientController::class, 'getClients'])->name('clients');
    Route::get('/report', [ReportController::class, 'getReport'])->name('report');
    Route::get('/reportCsv', [ReportController::class, 'getReportCsv'])->name('reportCsv');
    Route::get('/addClient', function () {
        return view('addClient');
    })->name('addClient');
    Route::post('createClient', [ClientController::class, 'createClient'])->name('createClient');
    Route::get('editClient/{clientId}', [ClientController::class, 'editClient'])->name('editClient');
    Route::put('updateClient/{clientId}', [ClientController::class, 'updateClient'])->name('updateClient');
    Route::post('createCashLoan/{clientId}', [ProductController::class, 'createCashLoan'])->name('createCashLoan');
    Route::put('updateCashLoan/{cashLoanId}', [ProductController::class, 'updateCashLoan'])->name('updateCashLoan');
    Route::post('createHomeLoan/{clientId}', [ProductController::class, 'createHomeLoan'])->name('createHomeLoan');
    Route::put('updateHomeLoan/{homeLoanId}', [ProductController::class, 'updateHomeLoan'])->name('updateHomeLoan');
});

require __DIR__.'/auth.php';
