<?php

if (config('filetinmel.backend')) {

    Route::prefix('filetinmel')
        ->middleware('web')
        ->name('filetinmel.')
        ->group(function () {

            if (config('filetinmel.env') == 'local') {
                Route::get('/test', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\FiletinmelController@test')->name('test');
            }

            Route::middleware('auth')
                ->group(function () {
                    Route::get('/', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\FiletinmelController@index')->name('index');
                });
        });

}

if (config('youtube.routes.enabled')) {

    Route::group(['prefix' => config('youtube.routes.prefix')], function () {

        /**
         * Authentication
         */
        Route::get(config('youtube.routes.authentication_uri'), function () {
            return redirect()->to(Youtube::createAuthUrl());
        });

        /**
         * Redirect
         */
        Route::get(config('youtube.routes.redirect_uri'), function (Illuminate\Http\Request $request) {
            if (!$request->has('code')) {
                throw new Exception('$_GET[\'code\'] is not set. Please re-authenticate.');
            }

            $token = Youtube::authenticate($request->get('code'));

            Youtube::saveAccessTokenToDB($token);

            return redirect(config('youtube.routes.redirect_back_uri', '/'));
        });

    });
}
