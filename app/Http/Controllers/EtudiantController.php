<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Etudiant;


// filepath: app/Http/Controllers/EtudiantController.php

class EtudiantController extends Controller
{
    public function index() {
    $etudiants = Etudiant::all();
    return view('etudiant.index', compact('etudiants'));
}
    public function dashboard()
    {
        return view('auth.etudiant.dashboard');
    }
    public function show()
    {
        // Assurez-vous que le chemin est correct
        return view('etudiant.dashboard');  // Cela correspond à resources/views/etudiant/dashboard.blade.php
    }
    public function consulterForm()
    {
    return view('etudiant.consulter');
    }
    public function paiementForm()
    {
    return view('etudiant.paiement');
    }
    public function inscriptionForm()
    {
    return view('etudiant.inscription');
    }
    public function ficheForm()
    {
    return view('etudiant.fiche');
    }
    public function planningForm()
    {
    return view('etudiant.planning');
    }
    public function historiqueForm()
    {
    return view('etudiant.historique');
    }
    public function annoncesForm()
    {
    return view('etudiant.annonces');
    }
}