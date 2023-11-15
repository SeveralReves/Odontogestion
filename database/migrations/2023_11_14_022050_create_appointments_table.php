<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->time('hour');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('appointments_type_id');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('status_id')->references('id')->on('appointment_status');
            $table->foreign('appointments_type_id')->references('id')->on('appointment_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
