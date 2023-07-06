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
use App\Http\Controllers\API\LaptopController;
use App\Http\Controllers\API\AccessoryController;
use App\Http\Controllers\API\PhoneController;
use App\Http\Controllers\API\ProductController;
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
Route::controller(AuthController::class)->group(function(){
    Route::get('home/user','index');
    Route::post('login','login');
    Route::post('user/register','create');
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user',function (Request $request){
        return [
            $request->user()
        ];
    }); 
    Route::controller(CategoryController::class)->group(function(){
        Route::get('category','index');
        Route::get('admin/category','home');
        Route::post('/category/create','create');
        Route::delete('/category/delete/{id}','delete');
        Route::post('/category/update/{id}','update');
    });

    Route::controller(PhoneController::class)->group(function(){
        Route::get('admin/phone','home');
        Route::post('phone/create','create');
        Route::delete('phone/delete/{id}','delete');
        Route::post('phone/update/{id}','update');
    });

    Route::controller(LaptopController::class)->group(function(){
        Route::get('laptop','index');
        Route::get('admin/laptop','home');
        Route::post('laptop/create','create');
        Route::delete('laptop/delete/{id}','delete');
        Route::post('laptop/update/{id}','update');
    });
    Route::controller(AccessoryController::class)->group(function(){
        Route::get('accessory','index');
        Route::get('admin/accessory','home');
        Route::post('accessory/create','create');
        Route::delete('accessory/delete/{id}','delete');
        Route::post('accessory/update/{id}','update');
    });
    Route::controller(LocationController::class)->group(function(){
        Route::get('location','index');
        Route::get('admin/location','home');
        Route::post('location/create','create');
        Route::delete('location/delete/{id}','delete');
        Route::post('location/update/{id}','update');
    });

    Route::controller(MenuController::class)->group(function(){
        Route::get('menu','index');
        Route::get('home/menu','home');
        Route::post('menu/create','create');
        Route::delete('menu/delete/{id}','delete');
        Route::post('menu/update/{id}','update');
    });

    Route::controller(PageController::class)->group(function(){
        Route::get('admin/page','home');
        Route::post('page/create','create');
        Route::delete('page/delete/{id}','delete');
        Route::post('page/update/{id}','update');
    });

    Route::controller(JobwikiController::class)->group(function(){
        Route::get('admin/jobwiki','home');
        Route::post('jobwiki/create','create');
        Route::delete('jobwiki/delete/{id}','delete');
        Route::post('jobwiki/update/{id}','update');
    });
    Route::controller(WikiController::class)->group(function(){
        Route::get('wiki','index');
        Route::get('admin/wiki','home');
        Route::post('wiki/create','create');
        Route::delete('wiki/delete/{id}','delete');
        Route::post('wiki/update/{id}','update');
        Route::post('wiki/updated/{id}','updateStatus');
    });
    Route::controller(NewsController::class)->group(function(){
        Route::get('news','index');
        Route::get('admin/news','home');
        Route::post('news/create','create');
        Route::delete('news/delete/{id}','delete');
        Route::post('news/updated/{id}','updateStatus');
        Route::post('news/update/{id}','update');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('admin/product','home');
        Route::post('product/create','create');
        Route::delete('product/delete/{id}','delete');
        Route::post('product/updated/{id}','updateChoose');
        Route::post('product/update/{id}','update');
    });
});

Route::controller(PageController::class)->group(function(){
    Route::get('page','index');
});
Route::controller(JobwikiController::class)->group(function(){
    Route::get('home/jobwiki','index');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('category','index');
});
Route::controller(LocationController::class)->group(function(){
    Route::get('location','index');
});
Route::controller(PhoneController::class)->group(function(){
    Route::get('phone','index');
});

Route::controller(LaptopController::class)->group(function(){
    Route::get('laptop','index');
});
Route::controller(AccessoryController::class)->group(function(){
    Route::get('accessory','index');
});
Route::controller(ContactController::class)->group(function(){
    Route::get('contact','index');
    Route::post('contact/create','create');
    Route::delete('contact/delete/{id}','delete');
    Route::post('contact/update/{id}','update');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('home/product/phone','showPhone');
    Route::get('home/product/laptop','showHomeLaptop');
    Route::get('home/product/ipad','showHomeIpad');
    Route::get('home/iphone','showIphone');
    Route::get('home/samsung','showSamSung');
    Route::get('home/laptop','showLaptop');
    Route::get('home/ipad','showIpad');
    Route::get('home/iphone/{id}','showByID');
});