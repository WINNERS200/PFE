<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
// Duplicate import removed
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// Importation du contrôleur RegisterController
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\EtudiantController;

use App\Http\Controllers\AdminController;


// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes de connexion
Route::get('/login/etudiant', [LoginController::class, 'etudiantLogin'])->name('login.etudiant');
Route::get('/login/responsable', [LoginController::class, 'responsableLogin'])->name('login.responsable');
Route::get('/login/admin', [LoginController::class, 'adminLogin'])->name('login.admin');

// Routes pour l'enregistrement
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/login/etudiant', [LoginController::class, 'etudiantLoginPost'])->name('login.etudiant.post');

Route::post('/', function (Request $request) {
    // Traitement du formulaire s'il envoie ici
    return "Formulaire soumis avec succès";
});

Route::get('/register/etudiant', [RegisterController::class, 'etudiantRegister'])->name('register.etudiant');
Route::post('/register/etudiant', [RegisterController::class, 'etudiantRegisterPost'])->name('register.etudiant.post');
Route::get('/dashboard/etudiant', function () {
    return view('etudiant.dashboard');
})->name('etudiant.dashboard');

Route::post('/login/etudiant', [LoginController::class, 'loginEtudiant'])->name('login.etudiant');
Route::post('/login/responsable', [LoginController::class, 'loginResponsable'])->name('login.responsable');
Route::post('/login/admin', [LoginController::class, 'loginAdmin'])->name('login.admin');


Route::post('/login/etudiant', [LoginController::class, 'login'])->name('login.etudiant');

// filepath: routes/web.php
Route::get('/etudiant/dashboard', function () {
    return view('auth.etudiant.dashboard');
});
Route::get('/etudiant/dashboard', [EtudiantController::class, 'dashboard']);

Route::get('/dashboard/responsable', function () {
    return view('responsable.dashboard');
})->name('responsable.dashboard');
Route::post('/login/responsable', [LoginController::class, 'loginResponsable'])->name('login.responsable');
Route::get('/dashboard/responsable', [ResponsableController::class, 'dashboard'])->name('responsable.dashboard');
use App\Http\Controllers\ResponsableController;

Route::get('/dashboard/responsable', [ResponsableController::class, 'index'])->name('dashboard.responsable');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login/etudiant');
})->name('logout');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login/responsable');
})->name('logout');

Route::get('/dashboard/etudiant', function () {
    return view('auth.etudiant.dashboard');
})->name('etudiant.dashboard');
Route::post('/login/etudiant', [LoginController::class, 'etudiantLoginPost'])->name('login.etudiant');

Route::get('/register/etudiant', [RegisterController::class, 'showEtudiantRegisterForm'])->name('register.etudiant');
Route::get('/dashboard/etudiant', function () {
    return view('etudiant.dashboard');
})->name('etudiant.dashboard');

Route::post('/register/etudiant', [RegisterController::class, 'createEtudiant'])->name('register.etudiant.submit');
Route::get('etudiant/dashboard', [EtudiantController::class, 'show'])->name('etudiant.dashboard');

Route::get('etudiant/dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard');
Route::get('etudiant/show', [EtudiantController::class, 'show']);  

Route::post('/etudiant/register', [RegisterController::class, 'createEtudiant'])->name('register.etudiant.submit');

// Route pour afficher le formulaire d'inscription
Route::get('/etudiant/register', [RegisterController::class, 'showEtudiantRegisterForm'])->name('register.etudiant');


// Route pour soumettre le formulaire d'inscription
Route::get('/dashboard/admin', [LoginController::class, 'adminDashboard'])->name('dashboard.admin');




Route::get('/etudiant/consulter', [EtudiantController::class, 'consulterForm'])->name('etudiant.consulter');
Route::get('/etudiant/paiement', [EtudiantController::class, 'paiementForm'])->name('etudiant.paiement');
Route::get('/etudiant/inscription', [EtudiantController::class, 'inscriptionForm'])->name('etudiant.inscription');
Route::get('/etudiant/fiche', [EtudiantController::class, 'ficheForm'])->name('etudiant.fiche');
Route::get('/etudiant/planning', [EtudiantController::class, 'planningForm'])->name('etudiant.planning');
Route::get('/etudiant/historique', [EtudiantController::class, 'historiqueForm'])->name('etudiant.historique');
Route::get('/etudiant/annonces', [EtudiantController::class, 'annoncesForm'])->name('etudiant.annonces');

Route::get('/responsable/planification', [ResponsableController::class, 'planificationForm'])->name('responsable.planification');
Route::get('/responsable/inscriptions', [ResponsableController::class, 'inscriptionsForm'])->name('responsable.inscriptions');
Route::get('/responsable/inscrit', [ResponsableController::class, 'inscritForm'])->name('responsable.inscrit');
Route::get('/responsable/affecter', [ResponsableController::class, 'affecterForm'])->name('responsable.affecter');
Route::get('/responsable/annonce', [ResponsableController::class, 'annonceForm'])->name('responsable.annonce');


Route::get('/admin/gestion_comptes', [AdminController::class, 'gestion_comptesForm'])->name('admin.gestion_comptes');
Route::get('/admin/gestion_filiers', [AdminController::class, 'gestion_filiersForm'])->name('admin.gestion_filiers');
Route::get('/admin/gestion_annees', [AdminController::class, 'gestion_anneesForm'])->name('admin.gestion_annees');

