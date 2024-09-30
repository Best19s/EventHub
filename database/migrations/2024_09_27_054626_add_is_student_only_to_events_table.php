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
      Schema::table('events', function (Blueprint $table) {
         $table->boolean('is_student_only')->default(false)->after('id_status_evt');
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::table('events', function (Blueprint $table) {
         $table->dropColumn('is_student_only');
      });
   }
};
