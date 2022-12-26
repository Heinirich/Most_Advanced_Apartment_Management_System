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
        Schema::create('rent_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->integer('amount_paid')->default(0);
            $table->string('bill_date');
            $table->string('bill_month');
            $table->string('bill_year');
            $table->enum('bill_status',[0,1])->default(0);
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
        Schema::dropIfExists('rent_collections');
    }
};
