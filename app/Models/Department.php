<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
   use HasFactory;
   use SoftDeletes;

   protected $table = 'departments';

   protected $primaryKey = 'idDepartments';

   public function users()
   {
      return $this->hasMany(User::class);
   }

   public function faculty()
   {
      return $this->belongsTo(Faculty::class, 'idFaculties');
   }
}
