<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'city', 'region'])]
class Commune extends Model
{
    public $timestamps = false;

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
