<?php

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

// Guide by @AnotherPanda12: 
	// get - get data from database to blade/view
	// post -post data to blade/view
	// put - update data in blade/view

use App\Wagon;
use App\Item;

Auth::routes();

Route::get('/', function() {
return redirect('/menu');
});

// Items
Route::get('/menu', 'ItemController@index'); // index.blade.php 

Route::get('/items/create', 'ItemController@create'); // create.blade.php (admin)
Route::post('/items/store', 'ItemController@store'); // create button - create.blade.php (admin)

Route::get('/items/{id}/edit', 'ItemController@edit'); // edit.blade.php (admin)
Route::put('/items/{id}', 'ItemController@update'); // update button - edit.blade.php (admin)

Route::get('/items/{id}/delete-confirm', 'ItemController@deleteConfirm'); // delete.blade.php (admin)
Route::delete('/items/{id}', 'ItemController@destroy'); // delete button - delete.blade.php (admin)

// Student List
Route::get('/student-list', 'UserController@index'); // student-list.blade.php (admin)

Route::get('/student-list/student-create', 'UserController@create'); // student-create.blade.php (admin)
Route::post('/student-list/store', 'UserController@store'); // create button - student-create.blade.php (admin)

Route::get('/student-list/{id}/student-edit', 'UserController@edit'); // student-edit.blade.php (admin)
Route::put('/student-list/{id}', 'UserController@update'); // update button - student-edit.blade.php (admin)

Route::get('/student-list/{id}/student-delete', 'UserController@deleteConfirm'); // student-delete.blade.php (admin)
Route::delete('/student-list/{id}', 'UserController@destroy'); // delete button - student-delete.blade.php (admin)

// Request Wagon
Route::get('/wagon/{id}', 'WagonController@create'); // wagon.blade.php (student)
Route::post('/wagon/store', 'WagonController@store'); // request button - wagon.blade.php (student)

Route::get('/on-hand/{id}', 'WagonController@update'); // on-hand.blade.php (student)

Route::get('/action', 'WagonController@show'); // action.blade.php (admin)

Route::put('/action/{id}/accept', 'WagonController@accept'); // accept button - action.blade.php (admin)
Route::put('/action/{id}/deny', 'WagonController@deny'); // deny button - action.blade.php (admin)

Route::get('/approved', 'WagonController@approved'); // approved.blade.php (admin)
Route::put('/approved/{id}/return', 'WagonController@return'); // return button - approved.blade.php (admin)

Route::get('/history', 'WagonController@history'); // history.blade.php (student)
Route::get('/transactions', 'WagonController@transactions'); // transactions.blade.php (admin)











