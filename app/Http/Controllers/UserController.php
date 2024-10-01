<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index()
   {


      $events = Event::whereIn('id_status_evt', [4, 2])->orderBy('evt_start_date', 'desc')->paginate(3);



      return view('welcome', compact( 'events'));
   }
}
