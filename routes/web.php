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

});

 Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
 Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/approvals/department', [ApprovalController::class, 'department'])->name('approvals.department');
// Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.department.approve');

// Route::middleware(['auth', 'role:department_head'])->group(function () {
//     Route::get('/approvals/department', [ApprovalController::class, 'department'])->name('approvals.department');
//     Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.department.approve');
//     Route::post('/approvals/{id}/deny', [ApprovalController::class, 'deny'])->name('approvals.department.deny');
// });

// Route::middleware(['auth', 'role:finance_head'])->group(function () {
//     Route::get('/approvals/finance', [ApprovalController::class, 'finance'])->name('approvals.finance');
//     Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.finance.approve');
// });
// Department Head
Route::prefix('approvals/department')->middleware(['auth', 'role:department_head'])->group(function () {
    Route::get('/', [ApprovalController::class, 'department'])->name('approvals.department');
    Route::post('/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.department.approve');
    Route::post('/{id}/deny', [ApprovalController::class, 'deny'])->name('approvals.department.deny');
});

// Finance Head
Route::prefix('approvals/finance')->middleware(['auth', 'role:finance_head'])->group(function () {
    Route::get('/', [ApprovalController::class, 'finance'])->name('approvals.finance');
    Route::post('/{id}/deny', [ApprovalController::class, 'deny'])->name('approvals.finance.deny');
    Route::post('/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.finance.approve');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/all-requests', [RightsRequestController::class, 'index'])->name('admin.requests');
});

Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::get('rights-requests', [RightsRequestController::class, 'showAll'])->name('rights-requests.showAll');
    Route::get('rights-requests/create', [RightsRequestController::class, 'create'])->name('rights-requests.create');
});

