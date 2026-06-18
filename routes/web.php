<?php

use App\Http\Controllers\Admin\HitmanApplicationController;
use App\Http\Controllers\Admin\UserAdministrationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContractAssignmentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractProductionController;
use App\Http\Controllers\GearInventoryController;
use App\Http\Controllers\HitmanAwardController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductionCompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:Admin'])
    ->group(function () {
        Route::get('/applications', [HitmanApplicationController::class, 'index'])->name('applications.index');
        Route::post('/applications/{application}/approve', [HitmanApplicationController::class, 'approve'])->name('applications.approve');
        Route::post('/applications/{application}/reject', [HitmanApplicationController::class, 'reject'])->name('applications.reject');

        Route::get('/users', [UserAdministrationController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserAdministrationController::class, 'create'])->name('users.create');
        Route::post('/users', [UserAdministrationController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserAdministrationController::class, 'destroy'])->name('users.destroy');
    });

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('contracts', ContractController::class);
Route::resource('contract-assignments', ContractAssignmentController::class);
Route::resource('ledger', LedgerController::class);
Route::resource('resources', ResourceController::class);
Route::resource('bookings', BookingController::class);
Route::resource('gear', GearInventoryController::class);
Route::resource('blogs', BlogController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('blacklist', BlacklistController::class);
Route::resource('announcements', AnnouncementController::class);
Route::resource('awards', AwardController::class);
Route::resource('hitman-awards', HitmanAwardController::class);
Route::resource('production-companies', ProductionCompanyController::class);
Route::resource('contract-production', ContractProductionController::class);


require __DIR__.'/auth.php';
