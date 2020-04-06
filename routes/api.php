<?php

//backend routes
if (config('filetinmel.backend')) {

    Route::prefix('api/filetinmel')
        ->middleware('api')
        ->name('api-filetinmel.')
        ->group(function () {

            Route::post('youtube', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@youtube')->name('youtube');

            Route::post('s3', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@s3')->name('s3');

            Route::get('files', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@files')->name('files');

        });

}
