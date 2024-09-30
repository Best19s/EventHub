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
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_evt');
            $table->unsignedBigInteger('id_evt_type');
            $table->foreign('id_evt_type')->references('id_evt_type')->on('event_types');
            $table->unsignedBigInteger('id_status_evt');
            $table->foreign('id_status_evt')->references('id_status_evt')->on('status_events');
            $table->string('evt_name');
            $table->string('evt_host');
            $table->string('evt_addr',255);
            $table->text('evt_detail');
            $table->string('evt_img',255);
            $table->integer('evt_max_attendant');
            $table->dateTime('evt_start_date');
            $table->dateTime('evt_end_date');
            $table->dateTime('evt_reg_start_date');
            $table->dateTime('evt_reg_end_date');
            $table->softDeletes();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
