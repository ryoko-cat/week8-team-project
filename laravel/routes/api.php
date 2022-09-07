<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\aboutItemController;
use App\Http\Controllers\RentalListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('items', [aboutItemController::class, 'index']); //localhost:8000/itemsにGETリクエストがきたら、ItemControllerのAllitemsメソッドに処理を振り分け
Route::get('items/{id}', [aboutItemController::class, 'show']);
Route::post('items', [aboutItemController::class, 'store']);
Route::get('rentalList', [rentalListController::class, 'index']);
Route::get('rentalList/{id}', [rentalListController::class, 'show']);
Route::post('rentalList', [rentalListController::class, 'store']);
Route::put('backItem/{id}', [rentalListController::class, 'update']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('period', [PeriodController::class, 'index']);

Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'signup']);