<?php
use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RightsRequestController;


Route::get('/', function () {
     return redirect()->route('rights-requests.create');
 });

Route::resource('rights-requests', RightsRequestController::class);



// Route::get('/rights-request', [RightsRequestController::class, 'create'])->name('rights-requests.create');
// Route::post('/rights-request', [RightsRequestController::class, 'store'])->name('rights-requests.store');
// Route::get('/rights-request/{id}', [RightsRequestController::class, 'show'])->name('rights-requests.show');
