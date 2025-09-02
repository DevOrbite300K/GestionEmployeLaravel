<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employe::select(
            'nom',
            'prenom',
            'email',
            'telephone',
            'matricule',
            'date_embauche',
            'est_responsable'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Matricule',
            'Date Embauche',
            'Responsable',
        ];
    }
}
