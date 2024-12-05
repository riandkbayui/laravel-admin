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

Route::group(["namespace" => "App\Http\Controllers\Web"], function () {
	Route::get("", "Home@index");
	Route::get("home", "Home@index");
	Route::get("sitemap.xml", "Home@sitemap");
	Route::get("blogs", "Home@blogs");
	Route::get("portfolio/{slug}", "Home@portfolio_read");
	Route::get("blogs/tag/{tag}", "Home@blogTag");
	Route::get("blogs/category/{tag}", "Home@blogCategory");
});

Route::group(["prefix" => "auth", "namespace" => "App\Http\Controllers\Web"], function () {
	Route::get("login", "Auth@login");
	Route::get("logout", "Auth@logout");
});

Route::prefix("member")
	->namespace("App\Http\Controllers\Web\Member")
	->middleware(["authentication"])
	->group(function () {
		Route::get("dashboard", "Dashboard@index");
		Route::get("profile", "Profile@index");
		Route::prefix("blogs")->group(function(){
			Route::get("", "Blogs@index");
			Route::get("create", "Blogs@create");
			Route::get("update/{id}", "Blogs@update");
		});
		Route::prefix("portfolios")->group(function(){
			Route::get("", "Portfolios@index");
			Route::get("create", "Portfolios@create");
			Route::get("update/{id}", "Portfolios@update");
		});
	});

Route::prefix("admin")
	->namespace("App\Http\Controllers\Web\Admin")
	->middleware(["authentication", "roleCheck:admin"])
	->group(function () {
		Route::prefix("users")->group(function(){
			Route::get("", "Users@index");
			Route::get("create", "Users@create");
			Route::get("update/{id}", "Users@update");
		});
		Route::get("configs", "Configs@index");
	});

Route::group(["namespace" => "App\Http\Controllers\Web"], function () {
	Route::get("{slug}", "Home@blogRead");
});