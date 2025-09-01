<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->name('admins', 'admins');






// Les routes concernant le role
Route::get('roles_permissions', [App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('listerolespermissions');
// Role
Route::get('roles_permissions/create-role', [App\Http\Controllers\Admin\RolePermissionController::class, 'createRoleForm'])->name('createroleform');
Route::post('roles_permissions/create-role', [App\Http\Controllers\Admin\RolePermissionController::class, 'createRole'])->name('createrole');

// Permission
Route::get('roles_permissions/create-permission', [App\Http\Controllers\Admin\RolePermissionController::class, 'createPermissionForm'])->name('createpermissionform');
Route::post('roles_permissions/create-permission', [App\Http\Controllers\Admin\RolePermissionController::class, 'createPermission'])->name('createpermission');

// assignation
Route::get('roles_permissions/assign-permission', [App\Http\Controllers\Admin\RolePermissionController::class, 'assignPermissionToRoleForm'])->name('assignpermissiontoroleform');
Route::post('roles_permissions/assign-permission', [App\Http\Controllers\Admin\RolePermissionController::class, 'assignPermissionToRole'])->name('assignpermissiontorole');

// Retirer une permission d'un rôle
Route::post('roles_permissions/remove-permission', [App\Http\Controllers\Admin\RolePermissionController::class, 'removePermissionFromRole'])->name('removepermissionfromrole');


// supprimer un role
Route::post('roles_permissions/delete-role/{id}', [App\Http\Controllers\Admin\RolePermissionController::class, 'deleteRole'])->name('deleterole');

// supprimer la permission
Route::post('roles_permissions/delete-permission/{id}', [App\Http\Controllers\Admin\RolePermissionController::class, 'deletePermission'])->name('deletepermission');