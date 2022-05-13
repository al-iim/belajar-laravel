<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| App->Providers->RouteServiceProvider
| Jangan Lupa Menggunakan Routegroup
|
*/

Route::get('/', function () {
    return view('about');
});
