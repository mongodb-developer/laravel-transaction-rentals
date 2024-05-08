<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;

Route::resource('bookings', BookingController::class)->only(['store']);

