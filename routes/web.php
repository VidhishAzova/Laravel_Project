<?php

use App\Http\Controllers\Crudcontroller;
use App\Http\Controllers\Orders;
use App\Http\Controllers\Products;
use App\Http\Controllers\SaleController;
use App\Models\Crud;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('conn');
});

//Route for customer registration
Route::get('/insert', [Crudcontroller::class,'viewandgetqualification']);
Route::resource('customer', Crudcontroller::class);

//Route for listing all customers
Route::get('/show', [Crudcontroller::class,'show']);

//Route for edit profile of a customer
Route::get('/edit/{crudid}', [Crudcontroller::class,'edit']);
Route::post('/update/{crudid}', [Crudcontroller::class,'update']);

//Route for removing customer details
Route::get('/delete/{uid}', [Crudcontroller::class,'destroy']);

//Route for customer and admin login and session
Route::get('/login', [Crudcontroller::class,'viewlogin']);

//Route for home page for admin and customer
Route::get('welcome', [Crudcontroller::class,'home']);

//Route for checking valid login
Route::post('/checklogin', [Crudcontroller::class,'checklogin']);

//Route for logout
Route::get('/logout', [Crudcontroller::class,'logout']);

//Route for adding products
Route::get('/addproducts', [Products::class,'addproducts']);
Route::post('/add', [Products::class,'addingproduct']);

//Route for viewing product details
Route::get('/viewproductdetails/{pid}', [Products::class,'viewproductdetails']);

//Route for updating product details
Route::post('/updateproduct/{pid}', [Products::class,'updateproduct']);


//Route for delete product details
Route::get('/deleteproduct/{pid}', [Products::class,'deleteproduct']);

//Route for viewing all customers
Route::get('/customers', [Crudcontroller::class,'showallcustomers']);


//Route for ordering product
Route::get('/orders', [Orders::class,'viewallcustomerorder']);
//Route for view all orders by cuatomers
Route::get('allorders', [Orders::class,'allordersview']);

//Route for forgot password
//view
Route::get('viewforgotpassword', [Crudcontroller::class,'viewforgotpassword']);
//function
Route::post('/submitForgetPasswordForm', [Crudcontroller::class,'submitForgetPasswordForm']);

//Route for reset password
//view
Route::get('/resetpasswordget/{token}', [Crudcontroller::class, 'showResetPasswordForm']);
//function
//Route::post('resetpasswordpost',[Crudcontroller::class,'passwordreset']);

//Route for orders
Route::post('/storeorder/{pid}', [Orders::class,'store']);

//Route for uploading csv file through batch method
Route::post('/upload', [SaleController::class,'uploadrecords']);

//Route for progressbar update
Route::get('fetchdata', [SaleController::class,'fetchdata']);

//Route for PDF Generation
Route::get('/pdf/{pdfid}', [Orders::class,'createPDF'])->name('downloadpdf');

//Route for Soft Delete
Route::post('softdelete', [Orders::class,'softdeletion']);

//Route for datatables using Ajax
//Route::get('allorders', [Orders::class, 'ajaxorders'])->name('ajaxorders');
