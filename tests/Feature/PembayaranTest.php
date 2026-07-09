<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    public function test_tanpa_token_ditolak(): void
    {
        $response = $this->postJson('/api/pembayaran', [
            'order_id' => 1,
            'jumlah' => 18000,
        ]);

        $response->assertStatus(401);
    }

    public function test_service_lain_bisa_buat_pembayaran_dengan_token_valid(): void
    {
        config(['services.internal_token' => 'rahasia-tes']);

        $response = $this->withHeaders(['X-Service-Token' => 'rahasia-tes'])
            ->postJson('/api/pembayaran', [
                'order_id' => 1,
                'jumlah' => 18000,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('pembayarans', [
            'order_id' => 1,
            'jumlah' => 18000,
            'status' => 'menunggu',
        ]);
    }
}
