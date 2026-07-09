<?php

namespace App\Repositories;

use App\Models\Pembayaran;
use Illuminate\Support\Collection;

class EloquentPembayaranRepository implements PembayaranRepository
{
    public function findByOrderId(int $orderId): ?Pembayaran
    {
        return Pembayaran::where('order_id', $orderId)->first();
    }

    public function all(): Collection
    {
        return Pembayaran::orderByDesc('id')->get();
    }

    public function save(array $data): Pembayaran
    {
        return Pembayaran::create($data);
    }
}
