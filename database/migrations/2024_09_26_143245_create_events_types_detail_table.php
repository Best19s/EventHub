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
      Schema::create('events_types_detail', function (Blueprint $table) {
         $table->unsignedBigInteger('id_evt');
         $table->unsignedBigInteger('id_evt_type');
         $table->primary(['id_evt', 'id_evt_type']);

         $table->foreign('id_evt')->references('id_evt')->on('events')->onDelete('cascade');
         $table->foreign('id_evt_type')->references('id_evt_type')->on('event_types')->onDelete('cascade');
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('events_types_detail');
   }
};
