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
        Schema::create('datereclamtions', function (Blueprint $table) {
            
            $table->id();

            $table->unsignedBigInteger('user_id');//bech enbadelha residence id
            $table->unsignedBigInteger('reclamtion_id');

            $table->dateTime('date');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reclamtion_id')->references('id')->on('reclamation_super_admins');

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
        Schema::dropIfExists('datereclamtions');
    }
};
