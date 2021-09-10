<?php


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category', 'API\CategoryController');

Route::apiResource('entry', 'API\EntryController');

Route::apiResource('answer', 'API\AnswerController');

Route::apiResource('statusoptions', 'API\StatusoptionController');

Route::apiResource('ticket', 'API\TicketController');

Route::apiResource('ticketinfo', 'API\TicketinfoController');