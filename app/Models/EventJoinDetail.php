<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventJoinDetail extends Model
{
   use HasFactory;
   use SoftDeletes;

   protected $table = 'events_detail';

   protected $primaryKey = 'id';
   public function eventDetail()
   {
      return $this->belongsTo(EventDetail::class, 'id_event_detail');
   }
}
