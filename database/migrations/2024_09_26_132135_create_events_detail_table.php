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
        Schema::create('events_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_evt');
            $table->foreign('id_evt')->references('id_evt')->on('events');
            $table->primary(['id_user', 'id_evt']);
            $table->unsignedBigInteger('id_status_user');
            $table->foreign('id_status_user')->references('id_status_user')->on('status_users');
            $table->string('feedback',255);
            $table->integer('rating');
            $table->dateTime('join_first_date');
            $table->dateTime('join_last_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_detail');
    }
};
