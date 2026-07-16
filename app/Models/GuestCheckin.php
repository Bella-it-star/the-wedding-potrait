<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuestCheckin extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'attended_count',
        'checked_in_by',
        'checked_in_at',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    public function souvenirTickets(): HasMany
    {
        return $this->hasMany(SouvenirTicket::class);
    }
}