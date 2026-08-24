<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Property Listings & Closed Deals Portfolio (Automated Routing)
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/portfolio', [PropertyController::class, 'portfolio'])->name('properties.portfolio');
Route::get('/closed-deals', [PropertyController::class, 'portfolio'])->name('closed-deals');
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Corporate Profile & Team
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team/{slug}', [TeamController::class, 'show'])->name('team.show');

// Contact & Valuation Requests
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/request-valuation', [ContactController::class, 'requestValuation'])->name('request-valuation');
Route::post('/inquiry', [ContactController::class, 'storeInquiry'])->name('inquiry.store')->middleware('throttle:10,1');

// Storage Asset Fallback Delivery (Guarantees 100% reliable image loading on shared hosts)
Route::get('/storage/{path}', function (string $path) {
    if (str_contains($path, '..') || str_contains($path, "\0")) {
        abort(404);
    }
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath) || !is_file($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath, [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('storage.fallback');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth Routes (Rate limited to 5 attempts per minute)
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Properties & Lifecycle Automation
        Route::resource('properties', AdminPropertyController::class);
        Route::post('properties/{property}/toggle-status', [AdminPropertyController::class, 'toggleStatus'])->name('properties.toggle-status');

        // Services Management
        Route::resource('services', AdminServiceController::class);

        // Team Management
        Route::resource('team', AdminTeamController::class);

        // Inquiries & Valuation Leads
        Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('inquiries.update');
        Route::delete('inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Admin Account & Password Security
        Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});
