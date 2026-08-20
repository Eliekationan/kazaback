<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Kaza's own notification log (push/SMS/email) — see Kaza_Schema_BDD.md §8.
 * Distinct from Illuminate\Notifications\DatabaseNotification, which is not used here.
 */
#[Fillable(['user_id', 'channel', 'type', 'title', 'body', 'data', 'sent_at'])]
class Notification extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'read_at' => 'datetime',
            'sent_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
