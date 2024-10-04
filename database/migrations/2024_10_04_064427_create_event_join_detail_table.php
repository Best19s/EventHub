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
        Schema::create('event_join_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event_detail');
            $table->foreign('id_event_detail')->references('id')->on('events_detail');
            $table->dateTime('join_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_join_detail');
    }
};
