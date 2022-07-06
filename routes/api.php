<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/zip-codes/{zipCode}', [App\Http\Controllers\Api\V1\ZipCodesController::class, 'show'])
    ->name('api.zip-codes.detail');
