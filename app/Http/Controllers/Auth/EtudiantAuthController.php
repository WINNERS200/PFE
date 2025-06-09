<?php
// filepath: app/Http/Controllers/Auth/EtudiantAuthController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.etudiant');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $etudiant = Etudiant::where('email', $request->email)->first();

        if ($etudiant && Hash::check($request->password, $etudiant->password)) {
            Auth::login($etudiant);
            return redirect()->intended('/dashboard-etudiant');
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }
}