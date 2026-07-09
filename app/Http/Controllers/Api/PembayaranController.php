<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PembayaranResource;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    public function __construct(private PembayaranService $pembayaranService)
    {
    }

    /**
     * Terima permintaan pembayaran baru dari service Toko Dapur FYP.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'metode' => 'nullable|string',
        ]);

        try {
            $pembayaran = $this->pembayaranService->createPembayaran($data);
        } catch (\InvalidArgumentException $e) {
            Log::warning('Gagal buat pembayaran', ['pesan' => $e->getMessage(), 'data' => $data]);

            return response()->json(['message' => $e->getMessage()], 422);
        }

        return (new PembayaranResource($pembayaran))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Cek status pembayaran berdasarkan order_id dari service lain.
     */
    public function show(string $orderId)
    {
        $pembayaran = $this->pembayaranService->findByOrderId((int) $orderId);

        if (! $pembayaran) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        return new PembayaranResource($pembayaran);
    }
}
