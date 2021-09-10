<?php

use Illuminate\Support\Facades\Route;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Entry as EntryResource;
use App\Entry;
use App\Category;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

//Route::get('', '')

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/admin', 'ContactFormController@index')->name('home');

Route::get('/test', 'BackendController@index')->name('test');

//für die weiterleitung nach dem registrieren
Route::get('/home', 'BackendController@index')->name('backend');



$links = Entry::select('link')
                ->pluck('link')->toArray();

/* $link = DB::table('entry')
            ->select('link')
            ->get();*/

Route::get('/ticket/{number}', 'StatusController@index')->name('ticket');

//Route::get('/{links}', 'StatusController@index');
