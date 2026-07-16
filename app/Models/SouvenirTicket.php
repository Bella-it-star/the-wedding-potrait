<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SouvenirTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'guest_checkin_id',
        'ticket_code',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function checkin(): BelongsTo
    {
        return $this->belongsTo(GuestCheckin::class, 'guest_checkin_id');
    }

    /**
     * Generate kode tiket unik, misal: SV-8F3K2A1B
     */
    public static function generateUniqueCode(): string
    {
        do {
            $code = 'SV-' . strtoupper(Str::random(8));
        } while (self::where('ticket_code', $code)->exists());

        return $code;
    }
}