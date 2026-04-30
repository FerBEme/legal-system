<?php

use App\Http\Controllers\Api\CaseModelController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FolderController;
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
    Route::apiResource('cases',CaseModelController::class);
    Route::apiResource('folders',FolderController::class);

    Route::post('users/{user}/restore',[UserController::class,'restore'])->withTrashed();
    Route::delete('users/{user}/force_delete',[UserController::class,'forceDelete'])->withTrashed();
    Route::post('specialties/{specialty}/restore',[SpecialtyController::class,'restore'])->withTrashed();
    Route::delete('specialties/{specialty}/force_delete',[SpecialtyController::class,'forceDelete'])->withTrashed();
    Route::post('customers/{customer}/restore',[CustomerController::class,'restore'])->withTrashed();
    Route::delete('customers/{customer}/force_delete',[CustomerController::class,'forceDelete'])->withTrashed();
    Route::post('cases/{case}/restore',[CaseModelController::class,'restore'])->withTrashed();
    Route::delete('cases/{case}/force_delete',[CaseModelController::class,'forceDelete'])->withTrashed();
    Route::post('folders/{folder}/restore',[FolderController::class,'restore'])->withTrashed();
    Route::delete('folders/{folder}/force_delete',[FolderController::class,'forceDelete'])->withTrashed();
});