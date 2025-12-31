<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Library HTTP Client (seperti 'requests' di Python)

class BpjsController extends Controller
{
    // Kita simpan Base URL API sumber (Node.js port 3000) di sini
    private $baseUrl = "http://localhost:3000/api/bpjs";

    // --- Fitur Peserta ---
    public function pesertaDetail($nik, $tglSEP)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/peserta/{$nik}/{$tglSEP}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(["error" => "Koneksi gagal: " . $e->getMessage()], 500);
        }
    }

    // --- Fitur Monitoring ---
    public function monitoringKunjunganDetail($tglMonitor, $jenisLayanan)
    {
        try {
            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::timeout(5)->get("{$this->baseUrl}/monitoring/kunjungan/{$tglMonitor}/{$jenisLayanan}");
            
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    // --- Fitur Rencana Kontrol ---
    public function rencanaKontrolDetail($tglAwal, $tglAkhir, $filter)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/rencanakontrol/{$tglAwal}/{$tglAkhir}/{$filter}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    // --- Fitur Rencana Kontrol No Kartu ---
    public function rencanaKontrolNoKPDetail($bulan, $tahun, $noKP, $filter)
    {
        // Pengganti .zfill(2) di Python
        $bulanFormatted = str_pad($bulan, 2, "0", STR_PAD_LEFT);

        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/rencanakontrol/noKP/{$bulanFormatted}/{$tahun}/{$noKP}/{$filter}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    // --- Fitur Antrean (POST) ---
    public function antreanReport(Request $request)
    {
        return response()->json([
            "status" => "JSON Laravel Diterima",
            "received" => $request->all()
        ], 201);
    }
}
