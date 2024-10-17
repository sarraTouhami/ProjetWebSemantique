<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToProduitsAlimentairesTable extends Migration
{
    public function up()
    {
        Schema::table('produits_alimentaires', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Optionally, if you want to create a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('produits_alimentaires', function (Blueprint $table) {
            // Drop the foreign key if it exists
            $table->dropForeign(['user_id']);
            
            // Drop the column
            $table->dropColumn('user_id');
        });
    }
}
