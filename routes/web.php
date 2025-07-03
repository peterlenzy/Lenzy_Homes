<?php
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RestrictToAdmin;

// Auth & Dashboard
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [
    'as' => 'dashboard',
    'uses' => function () {
        return view('dashboard');
    }
])->middleware(['auth', 'verified']);

Route::get('/aboutus', [
    'as' => 'aboutus',
    'uses' => function () {
        return view('aboutus');
    }
])->middleware(['auth', 'verified']);
Route::get('/contactus', [
    'as' => 'contactus',
    'uses' => function () {
        return view('contactus');
    }
])->middleware(['auth', 'verified']);
// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [
        'as' => 'profile.edit',
        'uses' => 'App\Http\Controllers\ProfileController@edit'
    ]);
    Route::patch('/profile', [
        'as' => 'profile.update',
        'uses' => 'App\Http\Controllers\ProfileController@update'
    ]);
    Route::delete('/profile', [
        'as' => 'profile.destroy',
        'uses' => 'App\Http\Controllers\ProfileController@destroy'
    ]);
    Route::post('/profile_img', [
        'as' => 'profile_img',
        'uses' => 'App\Http\Controllers\ProfileController@storeprofileimg'
    ]);

});

// User Routes
Route::middleware('auth')->group(function () {
    Route::post('/users/create', [
        'as' => 'users.store',
        'uses' => 'App\Http\Controllers\UserController@store'
    ]);
    Route::get('/users/index', [
        'as' => 'users.index',
        'uses' => 'App\Http\Controllers\UserController@index'
    ]);
    Route::patch('/users/{user}edit', [
        'as' => 'users.edit',
        'uses' => 'App\Http\Controllers\UserController@edit'
    ]);
    Route::patch('/users/{user}', [
        'as' => 'users.update',
        'uses' => 'App\Http\Controllers\UserController@update'
    ]);
    Route::delete('/users/delete', [
        'as' => 'users.delete',
        'uses' => 'App\Http\Controllers\UserController@delete'
    ]);
});

// House Routes
Route::middleware('auth')->group(function () {
    Route::get('/houses', [
        'as' => 'houses.index',
        'uses' => 'App\Http\Controllers\HouseController@index'
    ]);

    Route::post('/houses', [
        'as' => 'houses.store',
        'uses' => 'App\Http\Controllers\HouseController@store'
    ]);
    Route::get('/houses/{house}/edit', [
        'as' => 'houses.edit',
        'uses' => 'App\Http\Controllers\HouseController@edit'
    ]);
    Route::patch('/houses/{house}/update', [
        'as' => 'houses.update',
        'uses' => 'App\Http\Controllers\HouseController@update'
    ]);
    Route::delete('/houses/{house}/delete', [
        'as' => 'houses.destroy',
        'uses' => 'App\Http\Controllers\HouseController@destroy'
    ]);
});

// Client Routes
Route::middleware('auth')->group(function () {
    Route::post('/clients/create', [
        'as' => 'clients.store',
        'uses' => 'App\Http\Controllers\ClientController@store'
    ]);
    Route::get('/clients/show', [
        'as' => 'client.show',
        'uses' => 'App\Http\Controllers\ClientController@show'
    ]);
    Route::get('/clients/edit', [
        'as' => 'clients.edit',
        'uses' => 'App\Http\Controllers\ClientController@edit'
    ]);
    Route::delete('/clients/delete', [
        'as' => 'client.delete',
        'uses' => 'App\Http\Controllers\ClientController@delete'
    ]);
});
// Payment Routes
Route::middleware('auth')->group(function () {
    Route::get('/payments/create', [
        'as' => 'payments.create',
        'uses' => 'App\Http\Controllers\PaymentController@create'
    ]);
    Route::post('/payments', [
        'as' => 'payments.store',
        'uses' => 'App\Http\Controllers\PaymentController@store'
    ]);
    Route::get('/payments/index', [
        'as' => 'payments.index',
        'uses' => 'App\Http\Controllers\PaymentController@index'
    ]);
    Route::get('/payments/{payment}/edit', [
        'as' => 'payments.edit',
        'uses' => 'App\Http\Controllers\PaymentController@edit'
    ]);
     Route::patch('/payments/{payment}', [
        'as' => 'payments.update',
        'uses' => 'App\Http\Controllers\PaymentController@update'
    ]);

    Route::delete('/payments/delete', [
        'as' => 'payments.delete',
        'uses' => 'App\Http\Controllers\PaymentController@delete'
    ]);

});

Route::middleware(RestrictToAdmin::class)->group(function () {
    Route::get('/admin/dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'App\Http\Controllers\AdminController@index'
    ]);
    Route::get('/admin/users', [
        'as' => 'admin.users',
        'uses' => 'App\Http\Controllers\AdminController@users'
    ]);
});
Route::middleware([\App\Http\Middleware\RestrictToAdmin::class])->group(function () {
    Route::get('/payments/index', [
        'as' => 'payments.index',
        'uses' => 'App\Http\Controllers\PaymentController@index'
    ]);
    Route::get('/payments/{payment}/edit', [
        'as' => 'payments.edit',
        'uses' => 'App\Http\Controllers\PaymentController@edit'
    ]);
    Route::patch('/payments/{payment}', [
        'as' => 'payments.update',
        'uses' => 'App\Http\Controllers\PaymentController@update'
    ]);
    Route::delete('/payments/{payment}', [
        'as' => 'payments.destroy',
        'uses' => 'App\Http\Controllers\PaymentController@destroy'
    ]);
});
// Route::middleware([\App\Http\Middleware\RestrictToAdmin::class])->group(function () {
//     Route::post('/clients/create', [
//         'as' => 'clients.store',
//         'uses' => 'App\Http\Controllers\ClientController@store'
//     ]);
//     Route::get('/clients/index', [
//         'as' => 'client.index',
//         'uses' => 'App\Http\Controllers\ClientController@show'
//     ]);
//     Route::patch('/clients/edit', [
//         'as' => 'clients.edit',
//         'uses' => 'App\Http\Controllers\ClientController@edit'
//     ]);
//     Route::delete('/clients/delete', [
//         'as' => 'client.delete',
//         'uses' => 'App\Http\Controllers\ClientController@delete'
//     ]);
// });
Route::middleware([\App\Http\Middleware\RestrictToAdmin::class])->group(function () {

    Route::get('/houses/create', [
        'as' => 'houses.create',
        'uses' => 'App\Http\Controllers\HouseController@create'
    ]);
    Route::put('/houses', [
        'as' => 'houses.store',
        'uses' => 'App\Http\Controllers\HouseController@store'
    ]);
    Route::get('/houses/{house}/edit', [
        'as' => 'houses.edit',
        'uses' => 'App\Http\Controllers\HouseController@edit'
    ]);
    Route::patch('/houses/{house}/update', [
        'as' => 'houses.update',
        'uses' => 'App\Http\Controllers\HouseController@update'
    ]);
    Route::delete('/houses/{house}/delete', [
        'as' => 'houses.destroy',
        'uses' => 'App\Http\Controllers\HouseController@destroy'
    ]);
});
Route::middleware([\App\Http\Middleware\RestrictToAdmin::class])->group(function () {
      Route::get('/users/create', [
        'as' => 'users.create',
        'uses' => 'App\Http\Controllers\UserController@create'
    ]);
    Route::post('/users/store', [
        'as' => 'users.store',
        'uses' => 'App\Http\Controllers\UserController@store'
    ]);
    Route::get('/users/index', [
        'as' => 'users.index',
        'uses' => 'App\Http\Controllers\UserController@index'
    ]);
    Route::get('/users/{user}/show', [
        'as' => 'users.show',
        'uses' => 'App\Http\Controllers\UserController@show'
    ]);
    Route::patch('/users/{user}', [
        'as' => 'users.update',
        'uses' => 'App\Http\Controllers\UserController@update'
    ]);
    Route::get('/users/{user}/edit', [
        'as' => 'users.edit',
        'uses' => 'App\Http\Controllers\UserController@edit'
    ]);
    Route::delete('/users/{user}', [
        'as' => 'users.destroy',
        'uses' => 'App\Http\Controllers\UserController@destroy'
    ]);
});
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/get', [ImageController::class, 'getImages'])->name('images.get');



// Auth scaffolding
require __DIR__.'/auth.php';
