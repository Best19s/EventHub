<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
   use HasFactory;
   use SoftDeletes;

   protected $table = 'event_types';

   protected $primaryKey = 'id_evt_type';
   public function events()
   {
      return $this->belongsToMany(Event::class);
   }
}
