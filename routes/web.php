<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/baa', function (Request $request) {
//     $name = $request->query('name');
//     echo "Name ".$name;
//     return view('baa',['name'=> $name]);
// });

Route::get('/baa', function (Request $request) {
    // Get the 'name' query parameter from the URL
    $name = $request->query('name');
    
    // Pass the 'name' to the Blade view
    return view('baa', ['name' => $name]);
});

Route::get('/test', function () {
    $test = ['Etst', 'Isl', 'Mnt'];
    return  $test;
});