<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsAlimentairesTable extends Migration
{
    public function up()
    {
        Schema::create('produits_alimentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key for users table
            $table->string('nom');
            $table->string('categorie')->nullable();
            $table->integer('quantite');
            $table->date('date_peremption')->nullable();
            $table->string('type');
            $table->string('image_url')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits_alimentaires');
    }
}
