<?php

namespace App\Models;

use Database\Factories\TicketsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tickets extends Model
{
    /** @use HasFactory<TicketsFactory> */
    use HasFactory;

    public $guarded = [];

    public function Event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
