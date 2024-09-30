<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
   use HasFactory;
   use SoftDeletes;
   protected $table = 'events';

   protected $primaryKey = 'id_evt';

   public function eventDetails()
   {
      return $this->hasMany(EventDetail::class, 'id_evt');
   }

   public function eventType()
   {
      return $this->belongsTo(EventType::class, 'id_evt_type');
   }

   public function statusEvent()
   {
      return $this->belongsTo(StatusEvent::class, 'id_status_evt');
   }
}
