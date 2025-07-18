<?php
use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RightsRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApprovalController;

Route::middleware(  ['auth'])->group(function () {
    Route::get('/', function () {
     return redirect()->route('rights-requests.create');
 });
Route::resource('rights-requests', RightsRequestController::class);
Route::get('rights-requests', [App\Http\Controllers\RightsRequestController::class, 'showAll'])->name('rights-requests.showAll');
//Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
//Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
//Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


});

 Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
 Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/rights-request', [RightsRequestController::class, 'create'])->name('rights-requests.create');
// Route::post('/rights-request', [RightsRequestController::class, 'store'])->name('rights-requests.store');
// Route::get('/rights-request/{id}', [RightsRequestController::class, 'show'])->name('rights-requests.show');


Route::middleware(['auth', 'role:department_head'])->group(function () {
    Route::get('/approvals/department', [ApprovalController::class, 'department'])->name('approvals.department');
    Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.department.approve');
});

Route::middleware(['auth', 'role:finance_head'])->group(function () {
    Route::get('/approvals/finance', [ApprovalController::class, 'finance'])->name('approvals.finance');
    Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.finance.approve');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/all-requests', [RightsRequestController::class, 'index'])->name('admin.requests');
});
