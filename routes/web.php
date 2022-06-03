<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BELoginController;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });


// login and register
// Route::get('/', 'App\Http\Controllers\AuthController@index')->name('login');


// Route::get('/category','App\Http\Controllers\CategoryController@index');
// Route::get("/category/create",[CategoryController::class,'create'])->name('catecreate');
// Route::post("/category","App\Http\Controllers\CategoryController@store")->name('catesave');
// Route::get("/category/{categoryId}/edit","App\Http\Controllers\CategoryController@edit")->name('categoryedit');
// Route::put("/category/{categoryId}","App\Http\Controllers\CategoryController@update")->name('categoryupdate');
// Route::delete("/category/{categoryId}","App\Http\Controllers\CategoryController@destroy")->name('catedestroy');

// Route::resource("/posts","App\Http\Controllers\PostController");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// change password
Route::get('/change-password', 'App\Http\Controllers\changePasswordController@index')->name('form.password');
Route::post('/change-password', 'App\Http\Controllers\changePasswordController@store')->name('change.password');


// product
Route::post('/addproduct', 'App\Http\Controllers\ProductController@addproduct')->name('addproduct');

  
// Route::get('/', 'App\Http\Controllers\ProductController@index');  
Route::get('cart', 'App\Http\Controllers\ProductController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'App\Http\Controllers\ProductController@addToCart')->name('add.to.cart');
Route::patch('update-cart', 'App\Http\Controllers\ProductController@update')->name('update.cart');
Route::delete('remove-from-cart', 'App\Http\Controllers\ProductController@remove')->name('remove.from.cart');
Route::get('/checkout', 'App\Http\Controllers\ProductController@checkout')->name('cart.checkout');





//login and logout for backend user
Route::get('/', [BELoginController::class, 'index'])->name('be.login');
Route::post('/be-login', [BELoginController::class, 'postLogin'])->name('be.login.post');
Route::get('/be-logout', [BELoginController::class, 'logout'])->name('be.logout');

// Register
Route::get('/register-form', [BELoginController::class, 'registerform'])->name('registerform');



Route::middleware(['isAdmin'])->group(function () {

    Route::get('/admin', function () {
        $products = Product::all();
        $user = Auth::user();
        return view('admin.index')->with(compact('user', 'products'));
    });
    Route::get('/orders', function () {
        $orderdetail = OrderItem::all();
        return view('orderdetail.index', compact('orderdetail'));
    });
    Route::get('/users', function () {
            $users = User::all();
            return view('user.index', compact('users'));
    });


    // update profile
    Route::get('/update-profile/{user}',  'App\Http\Controllers\UpdateProfileController@editProfile')->name('profile.edit');
    Route::patch('/update-profile/{user}',  'App\Http\Controllers\UpdateProfileController@updateProfile')->name('profile.update');
    Route::delete('/remove_pro/{id}', 'App\Http\Controllers\ProductController@remove_pro')->name('remove_pro');
    Route::put('/update_pro/{id}', 'App\Http\Controllers\ProductController@update_pro')->name('update_pro');
    Route::get('/remove_user/{id}', 'App\Http\Controllers\ProductController@remove_user')->name('remove_user');

});

Route::middleware(['isNormal'])->group(function () {

    Route::get('/normal', function () {
        $product = Product::all();
        return view('normal.index',compact('product'));
    });

});
Route::post('/register-post', [BELoginController::class, 'register'])->name('be.register.post');