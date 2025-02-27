<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'loginPage');
});

Route::get('/r', function () {
    return view(view: 'homePage');
});
