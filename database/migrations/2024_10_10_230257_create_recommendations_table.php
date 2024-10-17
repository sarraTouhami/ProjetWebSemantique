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
        Schema::create('recommendations', function (Blueprint $table) {
    $table->id();
    $table->text('contenu');
    $table->enum('type', ['conservation', 'gestion des portions']);
    $table->enum('applicable_a', ['donateur', 'bénéficiaire']);
    $table->foreignId('user_id')->constrained('users'); // Foreign key for user
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
        Schema::dropIfExists('recommendations');
    }
};
