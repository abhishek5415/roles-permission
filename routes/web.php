<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::group(['middleware'=> ['role:super-admin|admin']], function(){
Route::group(['middleware'=> ['isAdmin']], function(){
    Route::resource('permissions',PermissionController::class);
    Route::get('permissions/{permissionId}/delete',[PermissionController::class,'destroy']);
    
    Route::resource('roles',RoleController::class);
    Route::get('roles/{roleId}/delete',[RoleController::class,'destroy']);     //->middleware('permission:delete role');
    Route::get('roles/{roleId}/give-permission',[RoleController::class,'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permission',[RoleController::class,'givePermissionToRole']);
    
    Route::resource('users',UserController::class);
    Route::get('users/{userId}/delete',[UserController::class,'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
