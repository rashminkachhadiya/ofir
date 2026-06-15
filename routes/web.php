<?php

use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function ($locale) {
    $supportedLocales = ['en', 'ru'];

    if (in_array($locale, $supportedLocales, true)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('language.switch');

Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'],
    function () {
        require base_path('routes/frontend/frontend.php');
    });


// Bakcend


// Admin Auth
Route::prefix('admin_login')->group(function () {
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
    Route::get('logout', 'Auth\Admin\LoginController@logout');
});

// Admin Dashborad
Route::group([
    'namespace' => 'Backend\Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:admin'],
    function () {
        require base_path('routes/backend/admin.php');
    });

// User Auth
Route::prefix('user_login')->group(function () {
    Route::get('login', 'Auth\User\LoginController@login')->name('user.auth.login');
    Route::post('login', 'Auth\User\LoginController@loginUser')->name('user.auth.loginUser');
    Route::post('logout', 'Auth\User\LoginController@logout')->name('user.auth.logout');
    Route::get('logout', 'Auth\User\LoginController@logout');
});

// User Dashborad
Route::group([
    'namespace' => 'Backend\User',
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => 'auth:user'],
    function () {
        require base_path('routes/backend/user.php');
    });

Route::prefix('user')->group(function () {
    Auth::routes(['verify'=>true]);
    // Route::get('login', 'Auth\User\LoginController@login')->name('user.auth.login');
    // Route::get('/register','Auth\User\RegisterController@showRegistrationForm')->name('user.auth.register');
    // Route::post('/register','Auth\User\RegisterController@register')->name('user.auth.registerUser');
    // Route::post('login', 'Auth\User\LoginController@loginUser')->name('user.auth.loginUser');
    // Route::post('logout', 'Auth\User\LoginController@logout')->name('user.auth.logout');
    // Route::get('logout', 'Auth\User\LoginController@logout');

    // Route::get('')
});
// clear config and cache
//['cache:clear', 'optimize', 'route:cache', 'route:clear', 'view:clear', 'config:cache']

//    /artisan/cache-clear  // replace (:) to (-)
//Route::get('/artisan/{cmd}', function($cmd) {
//   $cmd = trim(str_replace("-",":", $cmd));
//   $validCommands = ['cache:clear', 'optimize', 'route:cache', 'route:clear', 'view:clear', 'config:cache'];
//   if (in_array($cmd, $validCommands)) {
//      Artisan::call($cmd);
//      return "<h1>Ran Artisan command: {$cmd}</h1>";
//   } else {
//      return "<h1>Not valid Artisan command</h1>";
//   }
//});

