<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaire_beneficiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article');     
            $table->integer('quantite');       
            $table->date('date_peremption');   
            $table->string('localisation');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaire_beneficiaires');
    }
};
