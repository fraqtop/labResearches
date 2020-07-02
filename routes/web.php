<?php


Route::get('/{any}', function () {
    return view('spa');
})->where('any', '.*')->name('default');

Route::auth();