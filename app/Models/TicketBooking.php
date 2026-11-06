<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketBooking extends Model
{
    protected $fillable = [
        'booking_code',
        'full_name',
        'email',
        'phone',
        'birthdate',
        'ticket_type',
        'quantity',
        'total_price',
        'confirmation_token',
        'confirmation_expires_at',
        'confirmed_at',
    ];

    protected $hidden = ['confirmation_token'];

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'confirmation_expires_at' => 'datetime',
            'confirmed_at' => 'datetime',
        ];
    }

    public function ticketLabel(): string
    {
        return config("concert.tickets.{$this->ticket_type}.label", $this->ticket_type);
    }

    public function totalFormatted(): string
    {
        return self::rupiah($this->total_price);
    }

    public static function rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed_at !== null;
    }

    public function isExpired(): bool
    {
        return $this->confirmation_expires_at->isPast();
    }
}
