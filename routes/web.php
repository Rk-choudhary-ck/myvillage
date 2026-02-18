<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PlaceController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\VideoController;
use App\Http\Controllers\Frontend\CultureController;
use App\Http\Controllers\Frontend\ActivityController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\PlaceAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\VideoAdminController;
use App\Http\Controllers\Admin\CultureAdminController;
use App\Http\Controllers\Admin\ActivityAdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserAdminController;

/* ═══════════════════════════════════════
   FRONTEND ROUTES
═══════════════════════════════════════ */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Places
Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{slug}', [PlaceController::class, 'show'])->name('places.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{category}', [BlogController::class, 'byCategory'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Videos
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');

// Culture & Activities & Benefits
Route::get('/culture', [CultureController::class, 'index'])->name('culture.index');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/benefits', [ActivityController::class, 'benefits'])->name('benefits.index');

/* ═══════════════════════════════════════
   ADMIN AUTH ROUTES (Separate Login System)
═══════════════════════════════════════ */
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth — NOT protected by middleware
    Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    /* ─────────────────────────────────────
       PROTECTED ADMIN ROUTES
    ───────────────────────────────────── */
    Route::middleware(['admin.auth'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Blog Management
        Route::resource('blogs', BlogAdminController::class);
        Route::post('blogs/{blog}/toggle-publish', [BlogAdminController::class, 'togglePublish'])
             ->name('blogs.toggle-publish');
        Route::post('blogs/{blog}/toggle-featured', [BlogAdminController::class, 'toggleFeatured'])
             ->name('blogs.toggle-featured');

        // Places Management
        Route::resource('places', PlaceAdminController::class);
        Route::post('places/{place}/toggle-active', [PlaceAdminController::class, 'toggleActive'])
             ->name('places.toggle-active');
        Route::post('places/{place}/toggle-featured', [PlaceAdminController::class, 'toggleFeatured'])
             ->name('places.toggle-featured');

        // Gallery Management
        Route::resource('gallery', GalleryAdminController::class);
        Route::post('gallery/bulk-delete', [GalleryAdminController::class, 'bulkDelete'])
             ->name('gallery.bulk-delete');
        Route::post('gallery/bulk-upload', [GalleryAdminController::class, 'bulkUpload'])
             ->name('gallery.bulk-upload');

        // Video Management
        Route::resource('videos', VideoAdminController::class);
        Route::post('videos/{video}/toggle-featured', [VideoAdminController::class, 'toggleFeatured'])
             ->name('videos.toggle-featured');

        // Culture & Festivals
        Route::resource('culture', CultureAdminController::class);
        Route::post('culture/{culture}/toggle-active', [CultureAdminController::class, 'toggleActive'])
             ->name('culture.toggle-active');

        // Activities & Games
        Route::resource('activities', ActivityAdminController::class);

        // Hero Slider
        Route::resource('slider', SliderController::class)->names('slider');

        // User Management
        Route::resource('users', UserAdminController::class);
        Route::post('users/{user}/toggle-admin', [UserAdminController::class, 'toggleAdmin'])
             ->name('users.toggle-admin');
        Route::post('users/{user}/reset-password', [UserAdminController::class, 'resetPassword'])
             ->name('users.reset-password');

        // Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('settings/clear-cache', [SettingsController::class, 'clearCache'])
             ->name('settings.clear-cache');
    });
});
