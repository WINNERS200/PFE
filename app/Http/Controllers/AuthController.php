<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Responsable;
use App\Models\Administrateur;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticateEtudiant(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('etudiant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/etudiant/dashboard');
        }

        return back()->with('error', 'Identifiants incorrects.');
    }

    public function authenticateResponsable(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('responsable')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/responsable/dashboard');
        }

        return back()->with('error', 'Identifiants incorrects.');
    }

    public function authenticateAdministrateur(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('administrateur')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/administrateur/dashboard');
        }

        return back()->with('error', 'Identifiants incorrects.');
    }

    public function authenticateEnseignant(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('enseignant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/enseignant/dashboard');
        }

        return back()->with('error', 'Identifiants incorrects.');
    }

    public function registerEtudiant(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:etudiants',
            'password' => 'required|string|min:8|confirmed',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'numero_telephone' => 'required|string',
            'code_apogee' => 'required|string',
            'CNE' => 'required|string',
        ]);

        $etudiant = Etudiant::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'date_naissance' => $validated['date_naissance'],
            'lieu_naissance' => $validated['lieu_naissance'],
            'numero_telephone' => $validated['numero_telephone'],
            'code_apogee' => $validated['code_apogee'],
            'CNE' => $validated['CNE'],
        ]);

        Auth::guard('etudiant')->login($etudiant);
        return redirect('/etudiant/dashboard');
    }

    public function logout(Request $request)
    {
        $guards = ['etudiant', 'responsable', 'administrateur', 'enseignant'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}