<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    //Custom Keys
    Route::resource('customkeys', 'CustomKeysController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::get('players', 'UsersController@players')->name('users.players');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Game
     Route::get('games/compare', 'GameController@compare')->name('games.compare');
    Route::delete('games/destroy', 'GameController@massDestroy')->name('games.massDestroy');
    Route::resource('games', 'GameController');
    Route::get('games/{game}', 'GameController@view')->name('games.view');
   

    // Message
    Route::delete('messages/destroy', 'MessageController@massDestroy')->name('messages.massDestroy');
    Route::resource('messages', 'MessageController');

    // Level
     Route::get('level/{world}', 'LevelController@view')->name('levels.view');
    Route::delete('levels/destroy', 'LevelController@massDestroy')->name('levels.massDestroy');
    Route::resource('levels', 'LevelController');

    // World
     Route::get('worlds/create', 'WorldController@create')->name('worlds.create');
     Route::get('worlds/{game}', 'WorldController@view')->name('worlds.view');

    Route::delete('worlds/destroy', 'WorldController@massDestroy')->name('worlds.massDestroy');
    Route::resource('worlds', 'WorldController');

    // Analytic


   
    Route::delete('analytics/destroy', 'AnalyticController@massDestroy')->name('analytics.massDestroy');
    Route::resource('analytics', 'AnalyticController');

    // Custom Key
    Route::delete('custom-keys/destroy', 'CustomKeyController@massDestroy')->name('custom-keys.massDestroy');
    Route::resource('custom-keys', 'CustomKeyController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
