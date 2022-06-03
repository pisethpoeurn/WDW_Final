<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product', function(){
    return Product::all();
});

Route::get('product/{id}', function($id){
    return Product::find($id);
});
Route::post('product', function(Request $request){
    $data = $request->all();
    return Product::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'image' => $data['image'],
        'price' => $data['price']
    ]);
});

Route::put('product/{id}', function($id){
     Product::find($id)->delete();
     return "Deleted!";
});



// Route::middleware(['isAdmin'])->group(function () {

    Route::get('/admin','App\Http\Controllers\ProductController@view');
    Route::get('/orders', function () {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    });


    // update profile
    Route::get('/update-profile/{user}',  'App\Http\Controllers\UpdateProfileController@editProfile')->name('profile.edit');
    Route::patch('/update-profile/{user}',  'App\Http\Controllers\UpdateProfileController@updateProfile')->name('profile.update');

    Route::get('/remove_pro/{id}', 'App\Http\Controllers\ProductController@remove_pro')->name('remove_pro');
    Route::get('/update_pro/{id}', 'App\Http\Controllers\ProductController@update_pro')->name('update_pro');
//  });

Route::post('product', function(Request $request){
    $data = $request->all();
    return Product::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'image' => $data['image'],
        'price' => $data['price']
    ]);
});

Route::delete('product/{id}', function($id){
    Product::find($id)->delete();
    return "Deleted!";
});

Route::put('product/{id}', function(Request $request, $id){
   $product =  Product::find($id);
   $product->update($request->all());
    return $product;
});

Route::post('order', function(Request $request){
    $data = $request->all();
    return Order::create([
        'user_id' => $data['user_id'],
        'amount' => $data['amount']
    ]);
});


Route::get('order', function(){
    return Order::all();
});