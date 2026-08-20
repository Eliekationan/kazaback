<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'kyc_status', 'kyc_document_type', 'kyc_document_number', 'kyc_document_path', 'payout_phone', 'bio'])]
class HostProfile extends Model
{
    protected function casts(): array
    {
        return [
            'kyc_verified_at' => 'datetime',
            'response_rate' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kycVerifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kyc_verified_by');
    }
}
