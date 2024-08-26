<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Frontend routes
// Route::get('/', function () {
//     return view('frontend.welcome');
// })->name('frontend.welcome');

Route::prefix('tables/{table_no}')->group(function () {
    Route::get('/', [FrontendController::class, 'welcome'])->name('frontend.welcome');
    Route::get('/homepage', [FrontendController::class, 'homepage'])->name('frontend.homepage.index');
    Route::post('/store-phone', [CustomerController::class, 'store'])->name('frontend.store.phone');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('frontend.reviews.store');
    Route::get('/customer-review', [FrontendController::class, 'review'])->name('frontend.review');
    Route::post('/add-to-cart', [FrontendController::class, 'addToCart'])->name('frontend.add-to-cart');
    Route::post('/remove-from-cart', [FrontendController::class, 'removeFromCart'])->name('frontend.remove-from-cart');
    Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
    Route::get('/personal-information', [FrontendController::class, 'personalInfo'])->name('frontend.personal_information');
    Route::post('/customer-update', [CustomerController::class, 'updateCustomer'])->name('frontend.customer.update');
    Route::get('/transaction', [FrontendController::class, 'order'])->name('frontend.transaction');

});


// Admin / backend routes
// Admin / backend routes
Route::prefix('admin')->group(function () {

    // Guest routes (accessible only if not logged in)
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/auth', [AuthController::class, 'auth'])->name('login.auth');
    });

    // Redirect to login if accessing /admin directly
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Authenticated routes (accessible only if logged in)
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Routes accessible only by 'owner'
        Route::middleware([\App\Http\Middleware\CheckRoleMiddleware::class . ':owner'])->group(function () {
            Route::get('/owner-dashboard', [DashboardController::class, 'dashboardOwner'])->name('admin.owner.dashboard');
            Route::resource('data-admin', DataAdminController::class);
            // Route::resource('products', ProductController::class);
            Route::get('/reviews', [ReviewController::class, 'review'])->name('admin.review');
            Route::get('/report', [ReportController::class, 'report'])->name('admin.report');
            Route::get('/report/filter-sales', [ReportController::class, 'filterSales'])->name('admin.report.filter-sales');
        });

        // Routes accessible by 'owner' and 'dapur'
        Route::middleware([\App\Http\Middleware\CheckRoleMiddleware::class . ':owner,dapur'])->group(function () {
            Route::resource('products', ProductController::class);
        });

         // Routes accessible by 'kasir' and 'dapur'
         Route::middleware([\App\Http\Middleware\CheckRoleMiddleware::class . ':kasir,dapur,owner'])->group(function () {
            Route::resource('orders', OrderController::class);
            Route::put('/orders/{order_id}/change-status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
        });

        
        // Routes accessible by 'dapur'
        Route::middleware([\App\Http\Middleware\CheckRoleMiddleware::class . ':dapur'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'kitchenDashboard'])->name('admin.dashboard');
           
        });
        
        // Routes accessible by 'kasir'
        Route::middleware([\App\Http\Middleware\CheckRoleMiddleware::class . ':kasir'])->group(function () {
            Route::get('/kasir-dashboard', [DashboardController::class, 'cashierDashboard'])->name('admin.kasir.dashboard');
        });
        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('admin.dashboard');
        // Route::resource('data-admin', DataAdminController::class);
        // Route::get('/report', [ReportController::class, 'report'])->name('admin.report');
        // Route::get('/report/filter-sales', [ReportController::class, 'filterSales'])->name('admin.report.filter-sales');
        // Route::resource('products', ProductController::class);
        // Route::resource('orders', OrderController::class);
        // Route::put('/orders/{order_id}/change-status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');

    });
});