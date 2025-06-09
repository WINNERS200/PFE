<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Etudiant extends Authenticatable
{
    use Notifiable;

    protected $table = 'etudiants';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'date_naissance', 'lieu_naissance', 'numero_telephone', 'code_apogee', 'CNE'];
    protected $hidden = ['password', 'remember_token'];
}