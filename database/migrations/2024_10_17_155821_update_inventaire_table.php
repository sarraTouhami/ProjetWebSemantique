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
        Schema::table('inventaire_beneficiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article');     
            $table->integer('quantite');       
            $table->date('date_peremption');   
            $table->string('localisation');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaire_beneficiaires', function (Blueprint $table) {
            $table->dropColumn(['nom_article', 'quantite', 'date_peremption', 'localisation']);
        });
    }
};
