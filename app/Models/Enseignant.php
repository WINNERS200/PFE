<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Enseignant extends Authenticatable
{
    use Notifiable;

    protected $table = 'enseignants';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'matricule', 'specialite'];
    protected $hidden = ['password', 'remember_token'];
}