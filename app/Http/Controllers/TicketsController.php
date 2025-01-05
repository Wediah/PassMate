<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;

class TicketsController extends Controller
{
    public function storeTicket(Request $request): void
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:2',
            'price' => 'required|numeric',
            'ticket_type' => 'required|numeric',
            'event_id' => 'required|numeric|exists:events,id',
            'status' => 'required|numeric',
            'qr_code' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('qr_code')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('qr_code')->getRealPath())->getSecurePath();
            $validated['qr_code'] = $uploadedFileUrl;
        }

        $ticket = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'ticket_type' => $validated['ticket_type'],
            'event_id' => $validated['event_id'],
            'status' => $validated['status'],
            'qr_code' => $validated['qr_code'],
        ];

        Tickets::create($ticket);
    }
}
