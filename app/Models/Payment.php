<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'reservation_id', 'user_id', 'provider', 'provider_transaction_id', 'type', 'amount', 'currency',
    'status', 'escrow_status', 'held_at', 'released_at', 'raw_payload',
])]
class Payment extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:0',
            'held_at' => 'datetime',
            'released_at' => 'datetime',
            'raw_payload' => 'array',
        ];
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
