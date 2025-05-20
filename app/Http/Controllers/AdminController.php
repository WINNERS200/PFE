<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('auth.admin.dashboard');
    }
    public function gestion_comptesForm()
    {
        return view('admin.gestion_comptes');
    }public function gestion_filiersForm()
    {
        return view('admin.gestion_filiers');
    }
    public function gestion_anneesForm()
    {
        return view('admin.gestion_annees');
    }
}
