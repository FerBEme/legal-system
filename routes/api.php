<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:api')->group(function(){
    Route::get('me',[AuthController::class,'me']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('logout',[AuthController::class,'logout']);

    Route::apiResource('users',UserController::class);
    Route::apiResource('specialties',SpecialtyController::class);
    Route::apiResource('customers',CustomerController::class);

    Route::post('users/{user}/restore',[UserController::class,'restore'])->withTrashed();
    Route::delete('users/{user}/force_delete',[UserController::class,'forceDelete'])->withTrashed();
    Route::post('specialties/{specialty}/restore',[SpecialtyController::class,'restore'])->withTrashed();
    Route::delete('specialties/{specialty}/force_delete',[SpecialtyController::class,'forceDelete'])->withTrashed();
    Route::post('customers/{customer}/restore',[CustomerController::class,'restore'])->withTrashed();
    Route::delete('customers/{customer}/force_delete',[CustomerController::class,'forceDelete'])->withTrashed();
});