<?php


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/analyses', function () {
    return view('prices.list');
});

Auth::routes();
