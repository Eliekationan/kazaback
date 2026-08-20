<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Composite primary key (listing_id, date) — see Kaza_Schema_BDD.md §3.
 * Eloquent has no native composite-key support; prefer querying via
 * where('listing_id', ...)->where('date', ...) over find().
 */
#[Fillable(['listing_id', 'date', 'status', 'price_override'])]
class ListingCalendar extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'listing_id';

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'price_override' => 'decimal:0',
        ];
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
