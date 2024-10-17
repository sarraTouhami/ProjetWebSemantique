<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('is_admin');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('role', ['admin', 'donateur', 'beneficiaire', 'transporteur'])->default('beneficiaire');
            $table->string('phone_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('sector')->nullable();
            $table->string('association_name')->nullable();
            $table->string('restaurant_name')->nullable();
            $table->string('city')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('birthdate');
            $table->dropColumn('sector');
            $table->dropColumn('role');
            $table->dropColumn('association_name');
            $table->dropColumn('restaurant_name');
            $table->dropColumn('city');
            $table->dropColumn('bio');
            $table->dropColumn('profile_picture');
        });
    }
};
