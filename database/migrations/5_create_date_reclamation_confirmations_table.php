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
        Schema::create('date_reclamation_confirmations', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('date_id');
           $table->unsignedBigInteger('reclamtion_id');
  
            $table->date('date');

            $table->foreign('date_id')->references('id')->on('datereclamtions');
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
        Schema::dropIfExists('date_reclamation_confirmations');
    }
};
