<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailConTroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;
use Faker\Provider\ar_EG\Payment;
use Google\Service\Dfareporting\OrderContact; 

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
//     return view('welcome');
// });
Route::get('/',[HomeController::class,'index'])->name('home');

 // laptops
Route::post('/laptops',[LaptopController::class,'addToCart'])->name('laptops.addToCart');
Route::get('/laptops/{id}',[LaptopController::class,'getById'])->name('laptop_detail.index');
Route::get('/search',[LaptopController::class,'UserSearch'])->name('laptop.search');
Route::get('/laptops',[LaptopController::class,'index'])->name('laptops.index');
 // contact
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

 // about
Route::get('/about',[AboutUsController::class,'index'])->name('about.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  

    // orders
    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{id}',[OrderController::class,'getById'])->name('order.getById');
    Route::post('/orders/{id}',[OrderController::class,'create_or_update'])->name('order.update');
    Route::post('/checkout',[OrderController::class,'showFormOrder'])->name('order.show_create');
    Route::post('/orders',[OrderController::class,'create_or_update'])->name('order.create');
    Route::delete('/orders/{id}',[OrderController::class,'delete'])->name('orders.delete');
    Route::post('/orders/{id}',[OrderController::class,'received'])->name('order.receive');
    

    // cart
    Route::get('/carts',[CartController::class,'index'])->name('cart.index');
    Route::delete('/carts/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::post('/cart',[CartController::class,'add'])->name('cart.add');
    Route::post('/cart/{id}',[CartController::class,'update_quantity'])->name('cart.update_quantity');
    Route::get('/bill-mail/{id}',[EmailConTroller::class,'sendBillMail'])->name('mail.bill');
   
    Route::get('/vnpay_payment/{id}',[PaymentController::class,'create_vnpay_payment'])->name("vnpay_payment");
    Route::get('/vnpay_return',[PaymentController::class,'vnpay_return'])->name("vnpay_return");
});


Route::middleware('auth','admin')->group(function(){
    
    // managin laptops
    Route::get('/admin/laptops',[LaptopController::class,'index'])->name('admin_laptop.index');
    Route::get('/admin/laptops/search', [LaptopController::class, 'search'])->name('admin_laptop.search');
    Route::get('/admin/laptops/laptop-edit/{id}',[LaptopController::class,'showFormUpdate'])->name('admin_laptop.show_update');
    Route::get('/admin/laptops/laptop-edit',[LaptopController::class,'showFormCreate'])->name('admin_laptop.show_create');
    Route::post('/admin/laptops/laptop-edit',[LaptopController::class,'create_or_update'])->name('admin_laptop.create');
    Route::post('/admin/laptops/laptop-edit/{id}',[LaptopController::class,'create_or_update'])->name('admin_laptop.update');
    Route::delete('/admin/laptops/{id}',[LaptopController::class,'delete'])->name('admin_laptop.delete');
    Route::post('/admin/laptops/laptop-edit/images/{id}',[LaptopController::class,'update_slide_images'])->name('admin_laptop.update_slide_images');
    Route::delete('/admin/laptops/laptop-edit/images/{id}',[LaptopController::class,'delete_image'])->name('admin_laptop.delete_slide_images');

    // managing users.
    Route::get('/admin/users',[UserController::class,'index'])->name('admin_user.index');
    Route::post('/admin/users',[UserController::class,'create_or_update'])->name('admin_user.create_or_update');
    Route::get('/admin/users/search',[UserController::class,'search'])->name('admin_user.search');
    Route::delete('/admin/users/{id}',[UserController::class,'delete'])->name('admin_user.delete');

    // managin orders.
    Route::get('/admin/orders',[OrderController::class,'index'])->name('admin_order.index');
    Route::get('/admin/orders/search',[OrderController::class,'search'])->name('admin_order.search');
    Route::get('/admin/orders/{id}',[OrderController::class,'getById'])->name('admin_order.getById');
    Route::delete('/admin/orders/{id}',[OrderController::class,'delete'])->name('admin_order.delete');
    Route::get('/admin/orders/user_id/{id}',[OrderController::class,'searchByUserId'])->name('admin_order.searchByUserId');
    Route::post('/admin/orders/accept/{id}',[OrderController::class,'accepted'])->name('admin_order.accept');
    Route::post('/admin/orders/{id}',[OrderController::class,'deliver'])->name('admin_order.deliver');
    
});


require __DIR__.'/auth.php';
