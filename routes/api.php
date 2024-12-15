<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route untuk mengambil data dari API eksternal
Route::get('/fetch-games', function () {
    $apiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'; // Ganti dengan link API Anda

    try {
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'data' => $response->json(),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dari API.',
            ], $response->status());
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
});
