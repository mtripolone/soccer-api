<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/swagger-doc.yml', function () {
    return response()->file(base_path('swagger-doc.yml'));
});

require __DIR__.'/auth.php';
