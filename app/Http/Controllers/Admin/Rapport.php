<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;

class Rapport extends Controller
{
    public function index()
    {
        // affichage des Cinq employe recente
        $employes = Employe::orderBy('created_at', 'desc')->take(5)->get();

        // retourner le nombre total des employe
        $totalEmployes = Employe::count();

        return view('base.rapports.index', compact('employes', 'totalEmployes'));
    }
}
