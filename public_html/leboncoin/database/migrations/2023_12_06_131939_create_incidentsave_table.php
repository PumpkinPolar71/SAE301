<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsaveTable extends Migration
{
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id('idincident');
            $table->foreignId('idannonce')->constrained('annonce'); // Remplace 'annonces' par le nom de ta table d'annonces
            $table->boolean('remboursement')->default(false);
            $table->text('commentaire')->nullable();
            $table->boolean('procedurejuridique')->default(false);
            $table->boolean('resolu')->default(false);
            $table->timestamps(); // Ajoute les colonnes created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidents');
    }
};