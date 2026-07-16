<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'category',
        'invited_count',
        'table_number',
        'notes',
    ];

    public function checkin(): HasOne
    {
        return $this->hasOne(GuestCheckin::class);
    }

    public function souvenirTickets(): HasMany
    {
        return $this->hasMany(SouvenirTicket::class);
    }

    public function isCheckedIn(): bool
    {
        return $this->checkin()->exists();
    }
}