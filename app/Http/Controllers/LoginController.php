<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function etudiantLogin()
    {
        return view('auth.etudiant');
    }

    public function responsableLogin()
    {
        return view('auth.responsable');
    }

    public function adminLogin()
    {
        return view('auth.admin');
    }
    public function etudiantLoginPost(Request $request)
    {
        // Données saisies
        $email = $request->input('email');
        $password = $request->input('password');

        // 🔐 Authentification fictive désactivée → toujours rediriger
        return redirect('/dashboard/etudiant');
    }
    public function loginResponsable(Request $request)
    {
        // Données saisies
        $email = $request->input('email');
        $password = $request->input('password');

        // 🔐 Authentification fictive désactivée → toujours rediriger
        return redirect('/dashboard/responsable');
    }
    public function loginAdmin(Request $request)
    {
        // Données saisies
        $email = $request->input('email');
        $password = $request->input('password');

        // 🔐 Authentification fictive désactivée → toujours rediriger
        return redirect('/dashboard/admin');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login/etudiant');
    }
    public function logoutResponsable(Request $request)
    {
        Auth::logout();
        return redirect('/login/responsable');
    }
    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        return redirect('/login/admin');
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

}

