<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
