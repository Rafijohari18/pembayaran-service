<?php

namespace App\Repositories;

use App\Models\Pembayaran;
use Illuminate\Support\Collection;

interface PembayaranRepository
{
    public function findByOrderId(int $orderId): ?Pembayaran;

    public function all(): Collection;

    public function save(array $data): Pembayaran;
}
