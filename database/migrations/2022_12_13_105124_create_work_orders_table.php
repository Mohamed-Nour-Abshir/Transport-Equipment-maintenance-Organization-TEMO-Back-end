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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parts_id')->unsigned()->nullable();
            $table->string('quotation_from')->nullable();
            $table->string('quotation_to')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('vehicle_code')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('parts_code')->nullable();
            $table->string('parts_name')->nullable();
            $table->string('parts_price')->nullable();
            $table->string('parts_qty')->nullable();
            $table->decimal('order_parts_price')->nullable();
            $table->string('order_no')->nullable();
            $table->string('order_date')->nullable();
            $table->foreign('parts_id')->references('id')->on('parts_infos')->onDelete('cascade');
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
        Schema::dropIfExists('work_orders');
    }
};
