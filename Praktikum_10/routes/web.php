<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/category', function () {
    return view('category');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/details1', function () {
    return view('details1');
});

Route::get('/details2', function () {
    return view('details2');
});

Route::get('/details3', function () {
    return view('details3');
});


Route::get('/halo', function () {
 return 'Halo Laravel!';
});
