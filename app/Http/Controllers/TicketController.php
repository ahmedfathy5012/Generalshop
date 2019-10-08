<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
class TicketController extends Controller
{
    public function index(){  
        $tickets = Ticket::with(['tickettype','customer','order'])->paginate(env("PAGINATION_COUNT"));
        
        return view('admin.tickets.tickets')->with([
               'tickets' => $tickets ,
        ]);
    }
}
