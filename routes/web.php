<?php
use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RightsRequestController;
use App\Http\Controllers\AuthController;

Route::middleware(  ['auth'])->group(function () {
    Route::get('/', function () {
     return redirect()->route('rights-requests.create');
 });
Route::resource('rights-requests', RightsRequestController::class);
Route::get('rights-requests', [App\Http\Controllers\RightsRequestController::class, 'showAll'])->name('rights-requests.showAll');
Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


});

// Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
// Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/rights-request', [RightsRequestController::class, 'create'])->name('rights-requests.create');
// Route::post('/rights-request', [RightsRequestController::class, 'store'])->name('rights-requests.store');
// Route::get('/rights-request/{id}', [RightsRequestController::class, 'show'])->name('rights-requests.show');
