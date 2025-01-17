<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Cloudinary\Api\Exception\ApiError;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @throws ApiError
     */
    public function storeEvent(Request $request): void
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:2',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'expiry_date' => 'required|date'
        ]);

        if ($request->hasFile('image_path')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('image_path')->getRealPath())->getSecurePath();
            $validated['image_path'] = $uploadedFileUrl;
        }

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

        Event::create($event);
    }
}
