<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Employe; // ton modèle Employe
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        //  Définir les permissions
        $permissions = [
            // Employés
            'voir employes', 'creer employes', 'modifier employes', 'supprimer employes',

            // Départements
            'voir departements', 'creer departements', 'modifier departements', 'supprimer departements',

            // Contrats
            'voir contrats', 'creer contrats', 'modifier contrats', 'supprimer contrats', 'valider contrats',

            // Documents
            'voir documents', 'creer documents', 'modifier documents', 'supprimer documents', 'telecharger documents',

            // Pointages
            'voir pointages', 'creer pointages', 'modifier pointages', 'supprimer pointages', 'valider pointages',

            // Paiements
            'voir paiements', 'creer paiements', 'modifier paiements', 'supprimer paiements', 'exporter paiements',
        ];

        // créer les permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        //  Créer le rôle admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        //  Assigner toutes les permissions au rôle admin
        $adminRole->syncPermissions($permissions);

        //  Créer un employé admin
        $admin = Employe::firstOrCreate(
            ['email' => 'admin@gmail.com'], // email de référence
            [
                'nom' => 'admin',
                'password' => Hash::make('12345678'), // tu peux changer le mot de passe
            ]
        );

        //  Assigner le rôle admin à cet employé
        $admin->assignRole($adminRole);
    }
}
