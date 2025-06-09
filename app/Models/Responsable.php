<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Responsable extends Authenticatable
{
    use Notifiable;

    protected $table = 'responsables';
    protected $fillable = ['nom', 'prenom', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}