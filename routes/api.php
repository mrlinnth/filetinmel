<?php

use Illuminate\Http\Request;

//backend routes
if (config('filetinmel.backend')) {

    Route::prefix('api/filetinmel')
        ->middleware('api:auth')
        ->name('api-filetinmel.')
        ->group(function () {

            Route::get('/', function (Request $request) {
                return $request->user();
            })->name('index');

            // Route::apiResource('/plans', '\\Mrlinnth\\Filetinmel\\Http\\Controllers\\Api\\PlanController');

        });

}
