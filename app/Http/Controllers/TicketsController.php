<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:2',
            'price' => 'required|numeric',
            'ticket_type' => 'required|numeric',
            'event_id' => 'required|numeric|exists:events,id',
            'status' => 'required|numeric',
            'qr_code' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
