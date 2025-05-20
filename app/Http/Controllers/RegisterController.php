<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
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
