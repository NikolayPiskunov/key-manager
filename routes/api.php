<?php

use App\Http\Controllers\Api\KeyController;
use Illuminate\Support\Facades\Route;


Route::get('test', [KeyController::class, 'index']);
