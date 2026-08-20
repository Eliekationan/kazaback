<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['key', 'label_fr'])]
class Amenity extends Model
{
    public $timestamps = false;

    public function listings(): BelongsToMany
    {
        return $this->belongsToMany(Listing::class, 'listing_amenities');
    }
}
