<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTypeDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'event_type_detail';

   protected $primaryKey = 'id';

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_evt');
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'id_evt_type');
    }

}
