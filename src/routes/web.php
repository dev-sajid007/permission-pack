<?php

use DevSajid\Permission\Http\Controllers\RoleController;
use DevSajid\Permission\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;






Route::group(['as'=>'app.','prefix'=>'app','middleware'=>['web']],function () {

    Route::group(['as'=>'roles.','prefix'=>'roles'],function(){

        Route::get('/',[RoleController::class,'index'])->name('index');
        Route::get('/create',[RoleController::class,'create'])->name('create');
        Route::post('/store',[RoleController::class,'store'])->name('store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[RoleController::class,'update'])->name('update');
        Route::get('/delete/{id}',[RoleController::class,'delete'])->name('delete');
        
    });

    Route::group(['as'=>'users.','prefix'=>'users'],function(){

        Route::get('/',[UserController::class,'index'])->name('index');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::post('/store',[UserController::class,'store'])->name('store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[UserController::class,'update'])->name('update');
        Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');

    });

});