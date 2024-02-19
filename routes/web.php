<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ListController;
use App\Http\Controllers\backend\MediaController;
use App\Http\Controllers\backend\WebSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


// Yajra Data Table Start
Route::get('students', [StudentController::class, 'index']);
Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');
// Yajra Data Table End





//Sent SMS Start
// Send SMS by HTTP
Route::get('/sms', [HomeController::class, "sms"]);
// Send SMS by PHP Script
Route::get('/sms2', [HomeController::class, "sms2"]);
//Sent SMS End



//Drag and Drop Data Order Start
Route::get('/post/order', [PostController::class, 'post_order'])->name('post.post_order');
Route::post('/post/post_order_change', [PostController::class, 'post_order_change'])->name('post.order_change');
//Drag and Drop Data Order End


Route::get('posts/{status?}/{show_result?}/{s_query?}', [PostController::class, 'index'])->name('items.filter');
Route::delete('/delete_multipost', [PostController::class, 'delete_multipost'])->name('post.delete_multipost');


Auth::routes();


// Route::get('products/list', [ListController::class,'list'])->name('products.list');

//New Routes for Backend
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'dashboard'])->name('home');

    Route::resource('web_property', WebSettingsController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('categories/delete/{id}', [CategoryController::class, 'destroy']);

    Route::resource('products', ProductController::class);
    Route::get('product_list', [ProductController::class, 'list'])->name('products.list');

    //Media
    Route::get('media/all', [MediaController::class, 'index'])->name('media_index');
    Route::post('media/store', [MediaController::class, 'store'])->name('media_store');
    Route::post('media/store/noajax', [MediaController::class, 'storeMedia'])->name('media_store_noajax');
    Route::get('media/get', [MediaController::class, 'getMedia'])->name('media_get');
    Route::get('media/delete/{id}', [MediaController::class, 'destroy'])->name('media_delete');
});
