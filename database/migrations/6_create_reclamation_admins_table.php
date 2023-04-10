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
        Schema::create('reclamation_admins', function (Blueprint $table) {
            $table->id();

            $table->string('type_id');
           $table->unsignedBigInteger('user_id');
          
            $table->string('image')->nullable();
            $table->string('object');
            $table->string('payload');
            $table->timestamps();

            $table->foreign('type_id')->references('name')->on('type_reclamations');
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamation_admins');
    }
};
