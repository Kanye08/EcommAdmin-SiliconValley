<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



Route::get('/', function () {
    return view('auth.login');
});

// chat integration
Route::get('/chat', function () {
    return view('chat');
});
Route::post('/chat/send-message', function (Request $request) {
    event(new Message($request->input('username'), $request->input('message')));
    return ["success" => true];
});

Auth::routes();


Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');
    Route::get('/search', 'searchProducts');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('products', [App\Http\Controllers\Frontend\ProductController::class, 'index']);
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Category routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
        Route::delete('/category/{category}/delete', 'destroy');
    });

    // frontend products
    Route::get('products', [App\Http\Controllers\Admin\Frontend\ProductController::class, 'index']);

    // order route
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orders}', 'updateOrderStatus');

        // invoice
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');

        // Product routes
        Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
            Route::get('/products', 'index');
            Route::get('/products/create', 'create');
            Route::post('/products', 'store');
            Route::get('/products/{product}/edit', 'edit');
            Route::put('/products/{product}', 'update');
            Route::delete('/products/{product}/delete', 'destroy');
        });

        // brands
        Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

        // Task routes
        Route::controller(App\Http\Controllers\Admin\TaskController::class)->group(function () {
            Route::get('/tasks', 'index');
            Route::get('/tasks/create', 'create');
            Route::post('/tasks', 'store');
            Route::get('/tasks/{task_id}/edit', 'edit');
            Route::put('/tasks/{task_id}', 'update');
            Route::get('/tasks/generate', 'generateTask');
        });

        // search
        Route::get('/search', [App\Http\Controllers\Admin\SearchController::class, 'search']);


        // user controller

        Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
            Route::get('/users', 'index');
            Route::get('/users/create', 'create');
            Route::post('/users', 'store');
            Route::get('/users/{user_id}/edit', 'edit');
            Route::put('/users/{user_id}', 'update');
            Route::get('/users/{user_id}/delete', 'destroy');
        });
    });
});
