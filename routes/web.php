<?php


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/price-list', function () {
    return view('prices.list');
});

Auth::routes();
