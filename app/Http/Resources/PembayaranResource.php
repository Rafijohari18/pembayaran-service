<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'jumlah' => $this->jumlah,
            'metode' => $this->metode,
            'status' => $this->status,
            'waktu_bayar' => $this->waktu_bayar,
        ];
    }
}
