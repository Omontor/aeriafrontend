<?php



Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Game
    Route::apiResource('games', 'GameApiController');

    // Message
    Route::apiResource('messages', 'MessageApiController');

    // Level
    Route::apiResource('levels', 'LevelApiController');

    // World
    Route::apiResource('worlds', 'WorldApiController');

    // Analytic
    Route::apiResource('analytics', 'AnalyticApiController');

    // Custom Key
    Route::apiResource('custom-keys', 'CustomKeyApiController');
});
