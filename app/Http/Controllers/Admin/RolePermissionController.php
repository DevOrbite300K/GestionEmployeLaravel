<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('base/RolesPermissions/listerolespermissions', compact('roles', 'permissions'));
    }

    // affichage du formulaire de creation de role

    public function createRoleForm()
    {
        return view('base/RolesPermissions/creerrole');
    }

    // Affichage du formulaire de creation de permission
    public function createPermissionForm()
    {
        $options = [
            // Employés
            'voir employes',
            'creer employes',
            'modifier employes',
            'supprimer employes',

            // Départements
            'voir departements',
            'creer departements',
            'modifier departements',
            'supprimer departements',

            // Contrats
            'voir contrats',
            'creer contrats',
            'modifier contrats',
            'supprimer contrats',
            'valider contrats',

            // Documents
            'voir documents',
            'creer documents',
            'modifier documents',
            'supprimer documents',
            'telecharger documents',

            // Pointages
            'voir pointages',
            'creer pointages',
            'modifier pointages',
            'supprimer pointages',
            'valider pointages',

            // Paiements
            'voir paiements',
            'creer paiements',
            'modifier paiements',
            'supprimer paiements',
            'exporter paiements',
        ];
        return view('base/RolesPermissions/creerpermission', compact('options'));
    }




    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('listerolespermissions')->with('success', 'Role created successfully.');
    }

    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('listerolespermissions')->with('success', 'Permission created successfully.');
    }


    public function assignPermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        $role->givePermissionTo($permission->name);

        return redirect()->route('listerolespermissions')->with('success', 'Permission assigned to role successfully.');
    }


    // affichage du formulaire d'assignation de role
    public function assignPermissionToRoleForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('base/RolesPermissions/assignpermissiontorole', compact('roles', 'permissions'));
    }





    // enlever une permission a un role
    public function removePermissionFromRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        $role->revokePermissionTo($permission->name);

        return redirect()->route('listerolespermissions')->with('success', 'Permission removed from role successfully.');
    }



    // Supprimer un role
    public function deleteRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('listerolespermissions')->with('success', 'Role deleted successfully.');
    }

    // supprimer la permission

    public function deletePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('listerolespermissions')->with('success', 'Permission deleted successfully.');
    }

}
