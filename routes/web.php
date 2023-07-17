<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\admin\ColorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view ('welcome');
// });

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}','products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');
    Route::get('/new-arrivals', 'newArrivals');
    Route::get('/featured-products', 'featuredProducts');

});



Route::middleware(['auth'])->group(function () {
    
    Route::get('/wishlist', [App\Http\Controllers\Frontend\wishlistController::class, 'index']);
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');
    Route::get('/orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('/orders/{order_id}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
    // Route::get('/invoice/{order_id}/generate', [App\Http\Controllers\Frontend\OrderController::class, 'generateInvoice']);

    
});

Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index']);


    Route::get('settings', [App\Http\Controllers\admin\SettingController::class, 'index']);


    Route::controller(App\Http\Controllers\admin\OrderController::class)->group(function () {
        Route::get('/orders','index');
        Route::get('/orders/{order_id}','show');
        Route::put('/orders/{order_id}','updateOrderStatus');



        Route::get('/invoice/{order_id}','viewInvoice');
        Route::get('/invoice/{order_id}/generate','generateInvoice');
        
    });

    Route::controller(App\Http\Controllers\admin\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');




    });


    //category routes
    Route::controller(App\Http\Controllers\admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
        
    });

        //products routes
        Route::controller(App\Http\Controllers\admin\productController::class)->group(function () {
            Route::get('/products', 'index');
            Route::get('/products/create', 'create');
            Route::post('/products','store');
            Route::get('/products/{products}/edit', 'edit');
            Route::put('/products/{products}', 'update');
            Route::get('product-image/{product_image_id}/delete', 'destroyImage');
            Route::get('products/{product_id}/delete', 'destroy');

            Route::post('product-color/{prod_color_id}','updateProductColorQty');
            Route::get('product-color/{prod_color_id}/delete','deleteProductColor');
        
    });



    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create','store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('colors/{color_id}/delete', 'destroy');
    });

});


Route::get('paypal-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('done-transaction', [PayPalController::class, 'cancelTransaction'])->name('doneTransaction');



?>