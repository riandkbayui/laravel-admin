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

Route::namespace("App\Http\Controllers\Api")
	->group(function () {
		Route::prefix("auth")->group(function () {
			Route::post("login", "Auth@login");
		});
		Route::middleware("authentication")->group(function(){
			Route::post("profile", "Profile@index");
			Route::prefix("blogs")->group(function(){
				Route::post("datatable", "Blogs@datatable");
				Route::post("upload_img", "Blogs@upload_img");
				Route::post("create", "Blogs@create");
				Route::post("update", "Blogs@update");
			});
			Route::prefix("portfolios")->group(function(){
				Route::post("datatable", "Portfolios@datatable");
				Route::post("upload_img", "Portfolios@upload_img");
				Route::post("create", "Portfolios@create");
				Route::post("update", "Portfolios@update");
			});
			Route::middleware("roleCheck:admin")->group(function(){
				Route::prefix("users")->group(function(){
					Route::post("datatable", "Users@datatable");
					Route::post("update", "Users@update");
					Route::post("create", "Users@create");
				});
				Route::prefix("configs")->group(function(){
					Route::post("datatable", "Configs@datatable");
					Route::post("update", "Configs@update");
				});
			});
		});
	});
