<?php
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RestrictToAdmin;
use App\Models\Houses;
use App\Livewire\Chat;

// Auth & Dashboard
Route::get('/', function () {
    $houses = Houses::all();
    return view('welcome', compact('houses'));
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
Route::get('/help_center', [
    'as' => 'help_center',
    'uses' => function () {
        return view('help_center');
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

    Route::get('/search_house', [
        'as' => 'search_house',
        'uses' => 'App\Http\Controllers\HouseController@search_house'
    ]);
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
// Payment Routes
Route::middleware('auth')->group(function () {

    Route::get('/search_payment', [
        'as' => 'search_payment',
        'uses' => 'App\Http\Controllers\PaymentController@search_payment'
    ]);
    Route::get('/payments/{house}', [
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
     Route::get('/chat', function () {
        return view('chat');
    })->name('chat');


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
    Route::get('/payment/index', [
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
    ]);Route::get('/search_payment', [
        'as' => 'search_payment',
        'uses' => 'App\Http\Controllers\PaymentController@search_payment'
    ]);
     Route::get('/payment/archived', [
        'as' => 'payments.archived',
        'uses' => 'App\Http\Controllers\PaymentController@archived'
    ]);
     Route::post('/payments/{payment}/restore', [
        'as' => 'restore',
        'uses' => 'App\Http\Controllers\PaymentController@restore'
    ])->withTrashed();
});
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
    Route::get('/houses/archived', [
        'as' => 'houses.archived',
        'uses' => 'App\Http\Controllers\HouseController@archived'
    ]);
    Route::post('/houses/{house}/restore', [
        'as' => 'houses.restore',
        'uses' => 'App\Http\Controllers\HouseController@restore'
    ])->withTrashed();

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
    Route::get('/search', [
        'as' => 'search',
        'uses' => 'App\Http\Controllers\UserController@search'
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
    Route::get('/users', [
        'as' => 'users.archived',
        'uses' => 'App\Http\Controllers\UserController@archived'
    ]);
    Route::post('/users/{user}/restore', [
        'as' => 'restore',
        'uses' => 'App\Http\Controllers\UserController@restore'
    ])->withTrashed();

});
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/get', [ImageController::class, 'getImages'])->name('images.get');
Route::get('/houses/{house}/3d_view', [
        'as' => 'houses.3d_view',
        'uses' => 'App\Http\Controllers\HouseController@view3D'
    ]);
// Auth scaffolding
require __DIR__.'/auth.php';
