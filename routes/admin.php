<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;

Route::get('admin', [HomeController::class, 'index'])->name('admin.home');

/** si usamos prefix() en el archivo de  rutas aplicar este metodo
* Route::get('', function() {
*    return "Hola asministrador";
* });
*/ 
//crud para los roles
Route::resource('admin/users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

//llamar los metodos del modelo controlador

Route::resource('admin/categories', CategoryController::class)->names('admin.categories');

Route::resource('admin/tags', TagController::class)->names('admin.tags');

Route::resource('admin/posts', PostController::class)->names('admin.posts');

