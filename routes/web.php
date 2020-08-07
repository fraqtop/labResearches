<?php


Route::get('/{any}', function () {
    return view('spa');
})->where('any', '^(?!api).*$')->name('default');

Route::auth();