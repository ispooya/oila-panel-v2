<?php

use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Models\Post;


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


Route::get('/posts',function (){
    $posts = Post::orderBy('id', 'DESC')->Paginate(6);
    return $posts;
});
/**
 * @urlParam type string required Search posts by type ("event", "special-news", "general-news"). Example: event
 */
Route::get('/posts/by-type/{type}',function ($type){
    $posts = Post::where('contentType', $type)->paginate(10);
    return response()->json($posts->makeHidden(['id','user_id','updated_at']));
});
/**
 * @urlParam slug string required The slug of the post. Example: پست-جدید-گلرنگ-سیستم
 */
Route::get('/posts/{slug}',function ($slug){
    $posts = Post::where('slug', $slug)->first();
    return response()->json($posts->makeHidden(['user_id','updated_at']));
});

Route::post('/comment/store',[\App\Http\Controllers\CommentController::class, 'storeComment']);

Route::get('/get/boardmember',[ApiController::class, 'getBoardMember']);
Route::get('/get/managerscontact',[ApiController::class, 'getManagersContact']);
Route::get('/get/solution',[ApiController::class, 'getSolution']);
Route::get('/get/partner',[ApiController::class, 'getPartner']);
Route::get('/get/customer',[ApiController::class, 'getCustomer']);
Route::get('/get/homecustomer',[ApiController::class, 'getHomeCustomer']);
Route::get('/get/value',[ApiController::class, 'getValue']);
Route::get('/get/aboutus',[ApiController::class, 'getAboutUs']);
Route::get('/get/chart',[ApiController::class, 'getChart']);
Route::get('/get/socialpage',[ApiController::class, 'getSocialPage']);
Route::get('/get/posts/last',[ApiController::class, 'lastNews']);
Route::get('/get/posts/home',[ApiController::class, 'homeNews']);
Route::get('/get/ourstory-content',[ApiController::class, 'getOurStoryContent']);
Route::get('/get/job-content',[ApiController::class, 'getJobContent']);
Route::get('/get/products',[ApiController::class, 'getProducts']);

Route::get('/get/home-content',[ApiController::class, 'getHomeContent']);
Route::get('/get/product-page',[ApiController::class, 'getProductsPageContent']);
Route::get('/get/cat-product/{id}',[ApiController::class, 'getCatProducts']);
Route::get('/get/product/{id}',[ApiController::class, 'getProductInfo']);
Route::get('/get/contactus',[ApiController::class, 'getContactUs']);
Route::get('/get/faq',[ApiController::class, 'getAfq']);
Route::get('/get/mag-content',[ApiController::class, 'getMag']);
Route::get('/get/last-post',[ApiController::class, 'lastPost']);
Route::get('/get/post/{slug}',[ApiController::class, 'getPost']);
Route::get('/get/cat/{id}/posts',[ApiController::class, 'getCatPosts']);
Route::post('/contact/store',[MessageController::class, 'storeContact']);
Route::get('/get/about-us',[ApiController::class, 'getAboutUs']);
Route::get('/get/last-post-section',[ApiController::class, 'getLastPostSection']);






