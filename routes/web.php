<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('login');
});
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});