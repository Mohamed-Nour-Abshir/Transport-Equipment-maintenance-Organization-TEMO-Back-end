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
        Schema::create('parts_infos', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_code')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('parts_code')->nullable();
            $table->string('parts_name')->nullable();
            $table->string('parts_manufacture')->nullable();
            $table->string('parts_unit')->nullable();
            $table->string('parts_price')->nullable();
            $table->date('parts_date')->nullable();
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
        Schema::dropIfExists('parts_infos');
    }
};
