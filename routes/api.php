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

Route::resource('/skills', 'SkillController');

Route::resource('/users', 'UserController');

Route::resource('/job_skills', 'JobSkillController');

Route::put('/user_skills', 'UserSkillController@update');



