<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WebsiteController@indexView');
Route::get('/user-info/{id}', 'WebsiteController@getUserInfo');
Route::post('/update-user-info', 'WebsiteController@updateUserInfo');
Route::get('/recepti', 'WebsiteController@recipes');
Route::get('/emisije', 'WebsiteController@videos');
Route::get('/pretraga', 'WebsiteController@search');
Route::get('/search-by-term', 'WebsiteController@searchByTerm');
Route::get('/recept/{id}', 'WebsiteController@recipeView');
Route::get('/emisija/{id}', 'WebsiteController@videoView');
Route::post('/add-comment', 'WebsiteController@createComment');
Route::get('/kategorija/{type}', 'WebsiteController@getByCategory');
Route::get('/opis', 'WebsiteController@description');

Auth::routes();

Route::get('download', function() { return response()->download('..\public\Opis.pdf'); });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/my-recipes', 'RecipeController@index');
Route::get('/my-videos', 'VideoController@index');
Route::get('/my-comments', 'CommentController@index');

Route::get('/delete-user/{id}', 'HomeController@deleteUser');
Route::post('/add-user', 'HomeController@addUser');
Route::get('/edit-user/{id}', 'HomeController@editUser');
Route::post('/update-user', 'HomeController@updateUser');

Route::post('/add-recipe', 'RecipeController@addRecipe');
Route::get('/delete-recipe/{id}', 'RecipeController@delete');
Route::get('/edit-recipe/{id}', 'RecipeController@editRecipe');
Route::post('/update-recipe', 'RecipeController@updateRecipe');

Route::post('/add-video', 'VideoController@addVideo');
Route::get('/delete-video/{id}', 'VideoController@deleteVideo');
Route::get('/edit-video/{id}', 'VideoController@editVideo');
Route::post('/update-video', 'VideoController@updateVideo');


Route::get('/delete-comment/{id}', 'CommentController@deleteComment');