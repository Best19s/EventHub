<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventDetail extends Model
{
   use HasFactory;
   use SoftDeletes;
   protected $table = 'events_detail';

   protected $primaryKey = 'id';

   public function user()
   {
      return $this->belongsTo(User::class, 'id_user');
   }

   public function statusUser()
   {
      return $this->belongsTo(StatusUser::class, 'id_status_user');
   }

   public function event()
   {
      return $this->belongsTo(Event::class, 'id_evt');
   }
}
