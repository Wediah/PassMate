<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:2',
            'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'expiry_date' => 'required|date'
        ]);

        $event = [
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(event::class, 'slug', $validated['name']),
            'image_path' => $validated['image_path'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'expiry_date' => $validated['expiry_date']
        ];
    }
}
