<?php

//backend routes
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
