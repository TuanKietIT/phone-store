<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\JobwikiController;
use App\Http\Controllers\API\WikiController;
use App\Http\Controllers\API\NewsController;
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

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user',function (Request $request){
        return [
            $request->user()
        ];
    }); 
  
});

Route::controller(AuthController::class)->group(function(){
    Route::get('home/user','index');
    Route::post('login','login');
    Route::post('user/register','create');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category','index');
    Route::post('/category/create','create');
    Route::delete('/category/delete/{id}','delete');
    Route::post('/category/update/{id}','update');
});
Route::controller(PageController::class)->group(function(){
    Route::get('page','index');
    Route::post('page/create','create');
    Route::delete('page/delete/{id}','delete');
    Route::post('page/update/{id}','update');
});
Route::controller(MenuController::class)->group(function(){
    Route::get('menu','index');
    Route::get('home/menu','home');
    Route::post('menu/create','create');
    Route::delete('menu/delete/{id}','delete');
    Route::post('menu/update/{id}','update');
});
Route::controller(ContactController::class)->group(function(){
    Route::get('contact','index');
    Route::post('contact/create','create');
    Route::delete('contact/delete/{id}','delete');
    Route::post('contact/update/{id}','update');
});
Route::controller(LocationController::class)->group(function(){
    Route::get('location','index');
    Route::post('location/create','create');
    Route::delete('location/delete/{id}','delete');
    Route::post('location/update/{id}','update');
});
Route::controller(JobwikiController::class)->group(function(){
    Route::get('jobwiki','index');
    Route::post('jobwiki/create','create');
    Route::delete('jobwiki/delete/{id}','delete');
    Route::post('jobwiki/update/{id}','update');
});
Route::controller(WikiController::class)->group(function(){
    Route::get('wiki','index');
    Route::post('wiki/create','create');
    Route::delete('wiki/delete/{id}','delete');
    Route::post('wiki/update/{id}','update');
    Route::post('wiki/updated/{id}','updateStatus');
});
Route::controller(NewsController::class)->group(function(){
    Route::get('news','index');
    Route::get('home/news','home');
    Route::post('news/create','create');
    Route::delete('news/delete/{id}','delete');
    Route::post('news/updated/{id}','updateStatus');
    Route::post('news/update/{id}','update');
});