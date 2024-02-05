<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//import controller
use App\Http\Controllers\Controller;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/git_progress_task', [Controller::class, 'git_progress_task']);
Route::post('/update_progress_task', [Controller::class, 'update_progress_task']);
