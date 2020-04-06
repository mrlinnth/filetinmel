<?php

//backend routes
if (config('filetinmel.backend')) {

    Route::prefix('api/filetinmel')
        ->middleware('api')
        ->name('api-filetinmel.')
        ->group(function () {

            Route::post('youtube', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@youtube')->name('youtube');

            Route::post('upload/{f?}', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@upload')->name('upload');

            Route::get('files', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\UploadController@files')->name('files');

        });

}
