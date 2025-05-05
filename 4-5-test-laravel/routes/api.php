<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// login user
Route::post('/login', [LoginController::class, 'Login']);

// 4. Rate Limit
Route::middleware(['auth:sanctum', 'rate.limit', 'throttle: 200,1'])->get('/rate-limit', function (Request $request) {
    return $request->user();
});

// 5. Upload File
Route::post('/upload', [FileUploadController::class, 'upload']);
Route::get('/files/{filename}', [FileUploadController::class, 'getFile']);