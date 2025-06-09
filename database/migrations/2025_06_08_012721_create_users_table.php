<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('etudiant'); // 'etudiant', 'responsable', 'administrateur', 'enseignant'
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('numero_telephone')->nullable();
            $table->string('code_apogee')->nullable();
            $table->string('CNE')->nullable();
            $table->string('matricule')->nullable();
            $table->string('specialite')->nullable();
            $table->string('CIN')->nullable();
            $table->string('statut')->nullable(); // 'inscrit', 'non inscrit', 'diplômé', 'abandon'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}