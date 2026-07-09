<?php

use App\Http\Controllers\Api\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::middleware('service.token')->group(function () {
    Route::post('/pembayaran', [PembayaranController::class, 'store']);
    Route::get('/pembayaran/{orderId}', [PembayaranController::class, 'show']);
});
