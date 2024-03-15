<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CustomerCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BoardMemberController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ValueController;
use App\Http\Controllers\GeneralDetaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FaqController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/reload-captcha', [\App\Http\Controllers\Controller::class, 'reloadCaptcha']);


    Route::get('/message',[MessageController::class,'index'])->name('message.index');
    Route::post('/change-message-status',[MessageController::class,'changeStatus'])->name('changeMassageStatus');

    Route::get('/comment/{status}', [App\Http\Controllers\CommentController::class, 'index'])->name('comment.index');
    Route::post('/comment/accept', [\App\Http\Controllers\CommentController::class ,'acceptComment'])->name('comment.accept');
    Route::post('/comment/reject', [\App\Http\Controllers\CommentController::class ,'rejectComment'])->name('comment.reject');

    Route::get('/user', [UserController::class ,'index'])->name('users.index');
    Route::get('/user/create', [UserController::class ,'create'])->name('user.create');
    Route::post('/user/store', [UserController::class ,'store'])->name('user.store');
    Route::post('/user/update', [UserController::class ,'updateUser'])->name('user.update');
    Route::post('/user/disable', [UserController::class ,'disableUser'])->name('user.disable');
    Route::get('/user/{id}', [UserController::class ,'edit'])->name('user.edit');

    Route::get('/general/aboutus', [GeneralDetaController::class ,'aboutUs'])->name('general.aboutUs');
    Route::get('/general/home', [GeneralDetaController::class ,'home'])->name('general.home');
    Route::post('/general/aboutus/store', [GeneralDetaController::class ,'aboutUsStore'])->name('aboutUs.store');
    Route::get('/general/contactus', [GeneralDetaController::class ,'contactUs'])->name('general.contactUs');
    Route::post('/general/contactus/store', [GeneralDetaController::class ,'contactUsStore'])->name('contactUs.store');
    Route::post('/general/update', [GeneralDetaController::class ,'update'])->name('general.update');


//    oila version
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class ,'index'])->name('index');
        Route::get('/create', [ProductController::class ,'create'])->name('create');
        Route::post('/store', [ProductController::class ,'store'])->name('store');
        Route::get('/fpp', [ProductController::class ,'fppIndex'])->name('fpp');
        Route::post('/fpp/store', [ProductController::class ,'fppStore'])->name('fpp.store');
        Route::get('/fpp/destroy/{id}', [ProductController::class ,'fppDestroy'])->name('fpp.destroy');
        Route::get('/uses', [ProductController::class ,'usesIndex'])->name('uses');
        Route::post('/uses/store', [ProductController::class ,'usesStore'])->name('uses.store');
        Route::get('/uses/destroy/{id}', [ProductController::class ,'usesDestroy'])->name('uses.destroy');
        Route::get('/category', [ProductController::class ,'categoryIndex'])->name('category');
        Route::post('/category/store', [ProductController::class ,'categoryStore'])->name('category.store');
        Route::get('/category/destroy/{id}', [ProductController::class ,'categoryDestroy'])->name('category.destroy');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [ProductController::class ,'show'])->name('show');
        Route::post('/update/{id}', [ProductController::class ,'update'])->name('update');


    });
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class ,'index'])->name('index');
        Route::post('/store', [FaqController::class ,'store'])->name('store');
        Route::get('/{id}', [FaqController::class ,'show'])->name('show');
        Route::post('/update/{id}', [FaqController::class ,'update'])->name('update');
        Route::get('/destroy/{id}', [FaqController::class ,'destroy'])->name('destroy');
    });
    Route::prefix('seller')->name('seller.')->group(function () {
        Route::get('/', [SellerController::class ,'index'])->name('index');
        Route::post('/store', [SellerController::class ,'store'])->name('store');
        Route::get('/destroy/{id}', [SellerController::class ,'destroy'])->name('seller.destroy');
    });
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [PostController::class ,'index'])->name('index');
        Route::get('/store', [PostController::class ,'create'])->name('create');
        Route::post('/store', [PostController::class ,'store'])->name('store');
        Route::post('/update', [PostController::class ,'update'])->name('update');
        Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [PostController::class ,'edit'])->name('show');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class ,'index'])->name('index');
        Route::post('/store', [CategoryController::class ,'store'])->name('store');
        Route::get('/destroy/{id}', [CategoryController::class ,'destroy'])->name('destroy');
    });

    Route::post('/uploadphoto', [Controller::class ,'uploadImg'])->name('uploadPhoto');
    Route::post('/uploadtinyphoto', [Controller::class ,'uploadTinyImg'])->name('uploadTinyPhoto');
    Route::post('/uploadsellersphoto', [Controller::class ,'uploadSellerImg'])->name('uploadSellerPhoto');

});
