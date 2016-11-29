<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
Route::group(['middleware' => ['web']], function() {
    Route::get('/', function() {
        return view('welcome');
    });
    
    Route::auth();
    
    Route::get('/invoices/{contract}', 'InvoiceController@index')->name('invoiceindex');
    Route::post('/invoices/{contract}', 'InvoiceController@store')->name('invoicestore');
    Route::delete('/invoices/{contract}/{invoice}', 'InvoiceController@destroy')->name('invoicedestroy');
    Route::get('/invoice/{contract}/{invoice}', 'InvoiceController@individual');
    Route::post('/invoice/{contract}/{invoice}', 'InvoiceController@storeItem');
    Route::get('/invoices', 'InvoiceController@all');
    
    
    Route::delete('/invoice/{contract}/{invoice}/{item}', 'InvoiceController@destroyItem');
    
    Route::get('/home', 'HomeController@index');
    Route::get('/tasks', 'TaskController@index')->name('lalatask');
    Route::post('/tasks', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
       
    Route::get('/contracts/landlord', 'ContractController@index');
    Route::get('/contracts/tenant', 'ContractController@tenant');
    Route::post('/contracts/landlord', 'ContractController@store')->name('contractstore');
    Route::delete('/contract/{contract}', 'ContractController@destroy')->name('contractdestroy');
    
    Route::get('/contract/{contract}', 'ContractController@editForm');
    Route::post('/contract/{contract}', 'ContractController@edit');
    
    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
    
    Route::get('/stripeconnect', 'StripeController@connect');
    
    Route::post('/checkout/{contract}', 'StripeController@checkout');
    Route::post('/checkout/{invoice}', 'StripeController@individualCheckout');
    
    Route::get('/stripe', 'StripeController@index');
});




