<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'date_naissance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Vérifie si l'utilisateur est un étudiant.
     */
    public function isEtudiant()
    {
        return $this->role === 'etudiant';
    }

    /**
     * Vérifie si l'utilisateur est un responsable.
     */
    public function isResponsable()
    {
        return $this->role === 'responsable';
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdministrateur()
    {
        return $this->role === 'administrateur';
    }
}