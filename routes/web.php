<?php

use App\Model\Comment;
use App\Model\Department;
use App\Model\Post;
use Illuminate\Support\Facades\Route;
use App\User;

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

    $posts = Post::findOrFail(1);
    dd($posts->likes);

//    dd(Comment::where('post_id', 1)->get());
    $res = \App\Model\Post::first();//->toArray();
    dump($res->comment_number);
    dd($res->toArray());
});

Route::post('/user/unauthenticated', 'Api\UserController@unauthenticated')->name('unauthenticated');
