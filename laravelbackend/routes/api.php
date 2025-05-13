<?php

header('Access-Control-Allow-Origin: *');  // <-- ADD THIS LINE FIRST

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceReadingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Routes
Route::get('/student', [StudentController::class, 'index']);

// Device Routes
Route::prefix('devices')->group(function () {
    Route::get('/', [DeviceController::class, 'index']); // Get all devices
    Route::post('/', [DeviceController::class, 'store']); // Create new device
    Route::get('/{id}', [DeviceController::class, 'show']); // Get single device
    Route::put('/{id}', [DeviceController::class, 'update']); // Update device
    Route::delete('/{id}', [DeviceController::class, 'destroy']); // Delete device
    
    // Device Readings
    Route::get('/{id}/readings', [DeviceReadingController::class, 'index']); // Get all readings for device
    Route::post('/{id}/readings', [DeviceReadingController::class, 'store']); // Add new reading for device
});

// Readings Routes
Route::prefix('readings')->group(function () {
    Route::get('/', [DeviceReadingController::class, 'allReadings']); // Get all readings
    Route::get('/{id}', [DeviceReadingController::class, 'show']); // Get single reading
    Route::put('/{id}', [DeviceReadingController::class, 'update']); // Update reading
    Route::delete('/{id}', [DeviceReadingController::class, 'destroy']); // Delete reading
});

// User Authentication Route (example)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});