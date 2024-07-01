<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\NoteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




 

Route::controller(AuthController::class)->group(function () {
Route::post('/register' , 'register');


Route::post('/login' , 'login');
Route::post('/logout' , 'logout');


});




Route::controller(ProfileController::class)->middleware('auth:api')->group(function () {
    Route::get('/getUser' , 'getUser');
    
     
    Route::patch('/updateUser' , 'updateUser');

    
    });




    Route::controller(NoteController::class)->middleware('auth:api')->group(function () {
        Route::post('/store/note' , 'store');
        
         
    Route::get('/all/note' , 'index');
    
        Route::post('/note/update/{id}' , 'update');
        Route::delete('/delete/{id}' , 'delete');
        Route::get('/showByID/{id}' , 'showByID');

        });
    
    