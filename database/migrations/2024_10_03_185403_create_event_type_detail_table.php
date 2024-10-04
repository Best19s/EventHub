<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_type_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_evt');
            $table->foreign('id_evt')->references('id_evt')->on('events');
            $table->unsignedBigInteger('id_evt_type');
            $table->foreign('id_evt_type')->references('id_evt_type')->on('event_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_type_detail');
    }
};
