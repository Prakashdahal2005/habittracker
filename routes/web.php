<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::match(['get', 'post', 'patch', 'delete'], '/', [HabitController::class, 'handle']);

