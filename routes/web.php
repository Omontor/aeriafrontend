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
    Route::get('homeresync', 'HomeController@ResyncData')->name('homeresync');
    Route::get('secondsync', 'HomeController@secondsync')->name('secondsync');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');


    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::get('players', 'UsersController@players')->name('users.players');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Game

    
     Route::get('games', 'GameController@index')->name('games.index');   
     Route::get('games/create', 'GameController@create')->name('games.create');
     Route::get('games/dashboard/{id}', 'GameController@dashboard')->name('games.dashboard');
     Route::get('games/edit/{game}', 'GameController@edit')->name('games.edit');
     Route::get('games/{game}', 'GameController@view')->name('games.view');
     Route::get('games/delete/{id}', 'GameController@destroy')->name('games.destroy');
     Route::get('games/compare', 'GameController@compare')->name('games.compare');
     Route::post('games/filterbydate', 'GameController@filterByDate')->name('games.filterbydate');
     Route::get('games/resync', 'GameController@resync')->name('games.resync');
     Route::delete('games/massdestroy', 'GameController@massDestroy')->name('games.massDestroy');
   
  
   

    // Message
    Route::delete('messages/destroy', 'MessageController@massDestroy')->name('messages.massDestroy');
    Route::resource('messages', 'MessageController');

    // Level

    Route::get('level/{id}', 'LevelController@view')->name('levels.view');
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


    Route::get('customkeys/create', 'CustomKeyController@create')->name('customkeys.create');
    // Custom Key
    Route::get('custom-keys/{analytic}', 'CustomKeyController@view')->name('custom-keys.view');
    
    Route::delete('custom-keys/destroy', 'CustomKeyController@massDestroy')->name('custom-keys.massDestroy');
    Route::resource('custom-keys', 'CustomKeyController');

//notifications
     Route::get('notifications', 'NotificationController@index')->name('notifications.index');
     Route::get('notifications/create', 'NotificationController@create')->name('notifications.create');
     Route::post('notifications/store', 'NotificationController@store')->name('notifications.store');

//Leaderboards
     Route::get('leaderboards', 'LeaderboardController@index')->name('leaderboards.index');
     Route::get('leaderboards/game/{id}', 'LeaderboardController@game')->name('leaderboards.create');
     Route::get('leaderboards/show/{id}', 'LeaderboardController@show')->name('leaderboards.show');

//Level interfaces


      Route::get('levelinterfaces/create', 'LevelInterfaceController@create')->name('levelinterfaces.create');
     Route::get('levelinterfaces', 'LevelInterfaceController@index')->name('levelinterfaces.index');
      Route::get('levelinterfaces/{id}', 'LevelInterfaceController@view')->name('levelinterfaces.view');      




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
