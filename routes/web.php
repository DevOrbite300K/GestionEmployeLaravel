<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GestionEmploye;


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













// La gestion des employé
Route::resource('employes', GestionEmploye::class)->names([
    'index' => 'employes.index',
    'create' => 'employes.create',
    'store' => 'employes.store',
    'show' => 'employes.show',
    'edit' => 'employes.edit',
    'update' => 'employes.update',
    'destroy' => 'employes.destroy',
]);

// les routes pour assigner un role a un employe
Route::get('employes/{id}/assign-role', [GestionEmploye::class, 'showAssignRoleForm'])->name('employes.assign_role');
Route::post('employes/{id}/assign-role', [GestionEmploye::class, 'assignRoleToEmployee'])->name('employes.assign_role.post');


// pour les route de profile
Route::get('profile', [AdminController::class, 'profile'])->name('profile_admins');
Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('edit_profile_admins');
Route::post('profile/edit', [AdminController::class, 'updateProfile'])->name('update_profile_admins');



// les routes pour exporter les données
Route::get('employes/export/excel', [GestionEmploye::class, 'exportExcel'])->name('employes.export.excel');
Route::get('employes/export/pdf', [GestionEmploye::class, 'exportPDF'])->name('employes.export.pdf');





// Les routes de Gestion des departements
Route::resource('departements', App\Http\Controllers\Admin\GestionDepartement::class)->names([
    'index' => 'departements.index',
    'create' => 'departements.create',
    'store' => 'departements.store',
    'show' => 'departements.show',
    'edit' => 'departements.edit',
    'update' => 'departements.update',
    'destroy' => 'departements.destroy',
]);
