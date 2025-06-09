<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function etudiantRegisterPost(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:etudiants,email',
        'password' => 'required|confirmed|min:8',
    ]);

    Etudiant::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('etudiant.dashboard');
}
    // Affiche la vue du formulaire d'inscription
    public function showEtudiantRegisterForm()
    {
        return view('auth.register');
    }

    // Traitement de l'inscription
    public function etudiantRegister(Request $request)
    {
        // Tu peux ajouter la logique de validation et enregistrement ici...

        // Rediriger vers le dashboard après inscription
        return redirect('/etudiant/dashboard');
    }

    public function createEtudiant(Request $request)
{
    // Ici tu peux ajouter la logique d'enregistrement du nouvel étudiant
    // Ex : validation, création dans la base de données...

    // Pour l’instant on redirige simplement vers le dashboard étudiant
    return view('etudiant.dashboard');
}

}
