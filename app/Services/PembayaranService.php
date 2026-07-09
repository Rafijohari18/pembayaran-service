<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Repositories\PembayaranRepository;

class PembayaranService
{
    // dependency injection: bergantung ke interface PembayaranRepository, bukan implementasi langsung
    public function __construct(private PembayaranRepository $pembayaranRepository)
    {
    }

    public function findByOrderId(int $orderId): ?Pembayaran
    {
        return $this->pembayaranRepository->findByOrderId($orderId);
    }

    public function createPembayaran(array $data): Pembayaran
    {
        if ($data['jumlah'] < 1) {
            throw new \InvalidArgumentException('Jumlah pembayaran tidak valid');
        }

        $data['waktu_bayar'] = now();
        $data['status'] = $data['status'] ?? 'menunggu';
        $data['metode'] = $data['metode'] ?? 'transfer';

        return $this->pembayaranRepository->save($data);
    }
}
