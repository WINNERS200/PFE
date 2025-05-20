<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// filepath: app/Http/Controllers/ResponsableController.php

class ResponsableController extends Controller
{
    public function dashboard()
    {
        return view('auth.Responsable.dashboard');
    }
    public function index()
    {
        return view('responsable.dashboard');
    }
    public function planificationForm()
    {
        return view('responsable.planification');
    }
    public function inscriptionsForm()
    {
        return view('responsable.inscriptions');
    }
    public function inscritForm()
    {
        return view('responsable.inscrit');
    }
    public function affecterForm()
    {
        return view('responsable.affecter');
    }
    public function annonceForm()
    {
        return view('responsable.annonce');
    }
}