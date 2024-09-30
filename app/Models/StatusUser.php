<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusUser extends Model
{
   use HasFactory;
   use SoftDeletes;

   protected $table = 'status_users';

   protected $primaryKey = 'id_status_user';

   public function users()
   {
      return $this->hasMany(User::class);
   }
}
