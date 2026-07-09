<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['order_id', 'jumlah', 'metode', 'status', 'waktu_bayar'];

    protected function casts(): array
    {
        return [
            'waktu_bayar' => 'datetime',
        ];
    }
}
