<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GestionEmploye;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Employe\EmployeController;
use App\Models\Poste;
use App\Models\Departement;



Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
Auth::routes();
Route::get('/', [App\Http\Controllers\Employe\EmployeController::class, 'bienvenue']);

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




// Les routes Pour la Gestion des Documents
Route::resource('documents', App\Http\Controllers\Admin\GestionDocument::class)->names([
    'index' => 'documents.index',
    'create' => 'documents.create',
    'store' => 'documents.store',
    'show' => 'documents.show',
    'edit' => 'documents.edit',
    'update' => 'documents.update',
    'destroy' => 'documents.destroy',
]);


// les routes pour la Gestion des pointages

Route::resource('pointages', App\Http\Controllers\Admin\GestionPointage::class)->names([
    'index' => 'pointages.index',
    'create' => 'pointages.create',
    'store' => 'pointages.store',
    'show' => 'pointages.show',
    'edit' => 'pointages.edit',
    'update' => 'pointages.update',
    'destroy' => 'pointages.destroy',
    
]);

// les routes pour changer le statut d'un pointage
Route::get('pointages/{id}/changer-statut', [App\Http\Controllers\Admin\GestionPointage::class, 'afficherFormulaireChangementStatut'])->name('pointages.changer_statut');
Route::post('pointages/{id}/changer-statut', [App\Http\Controllers\Admin\GestionPointage::class, 'changerLeStatut'])->name('pointages.changer_statut.post');





// les routes de Gestion des postes
Route::resource('postes', App\Http\Controllers\Admin\GestionPoste::class)->names([
    'index' => 'postes.index',
    'create' => 'postes.create',
    'store' => 'postes.store',
    'show' => 'postes.show',
    'edit' => 'postes.edit',
    'update' => 'postes.update',
    'destroy' => 'postes.destroy',
    'bonjour' => 'postes.bonjour'
]);
// lier un employé à un poste
Route::get('postes/{id}/lier-employe', [App\Http\Controllers\Admin\GestionPoste::class, 'lierEmployePosteForm'])->name('postes.lier_employe');
Route::post('postes/{id}/lier-employe', [App\Http\Controllers\Admin\GestionPoste::class, 'lierEmployePoste'])->name('postes.lier_employe.post');




// les routes pour employe bienvenue
Route::get('/employe/bienvenue/', [App\Http\Controllers\Employe\EmployeController::class, 'bienvenue'])->name('employe.bienvenue');
Route::get('/employe/profile/', [App\Http\Controllers\Employe\EmployeController::class, 'profileEmploye'])->name('employe.profile');
Route::post('/employe/profile/modifier', [App\Http\Controllers\Employe\EmployeController::class, 'ModifierProfileEmployePoste'])->name('employe.profile.modifier');
Route::get('/employe/profile/modifier/get', [App\Http\Controllers\Employe\EmployeController::class, 'ModifierProfileEmployeGet'])->name('employe.profile.modifier.get');
// Employé - Changer mot de passe
Route::get('/employe/profile/changer-mot-de-passe', [App\Http\Controllers\Employe\EmployeController::class, 'changerMotDePasseGet'])
    ->name('employe.changerMotDePasse.get');

Route::post('/employe/profile/changer-mot-de-passe', [App\Http\Controllers\Employe\EmployeController::class, 'changerMotDePasse'])
    ->name('employe.changerMotDePasse');

// Employe vois ces documents
Route::get('/employe/documents', [App\Http\Controllers\Employe\EmployeController::class, 'mesDocuments'])
    ->name('employe.documents');
// Employe connecter ajoute document
// Afficher le formulaire d'upload + la liste des documents
Route::get('/employe/documents/upload', [App\Http\Controllers\Employe\EmployeController::class, 'UploadDocumentGet'])
    ->name('employe.documents.upload');

// Traiter l'upload d'un document
Route::post('/employe/documents/upload', [App\Http\Controllers\Employe\EmployeController::class, 'UploadDocumentPost'])
    ->name('employe.documents.upload.post');

// mes pointages
Route::get('/employe/pointages', [App\Http\Controllers\Employe\EmployeController::class, 'EmployePointage'])->name('employe.pointages');



// Afficher le formulaire ou le bouton de pointage
Route::get('/employe/pointage', [App\Http\Controllers\Employe\EmployeController::class, 'EmployePointageGet'])->name('employe.pointage');

// Pointer arrivée
Route::post('/employe/pointage', [App\Http\Controllers\Employe\EmployeController::class, 'EmployePointerArrivee'])->name('employe.pointage.post');

// Pointer départ
Route::post('/employe/pointage/depart', [App\Http\Controllers\Employe\EmployeController::class, 'EmployePointerDepart'])->name('employe.pointage.depart');




