<?php

use App\Http\Controllers\BpjsController;
use Illuminate\Support\Facades\Route;

// Prefix /api/ otomatis ditambahkan oleh Laravel
Route::get('bpjs/peserta/{nik}/{tglSEP}', [BpjsController::class, 'pesertaDetail']);
Route::get('bpjs/monitoring/kunjungan/{tglMonitor}/{jenisLayanan}', [BpjsController::class, 'monitoringKunjunganDetail']);
Route::get('bpjs/rencanakontrol/{tglAwal}/{tglAkhir}/{filter}', [BpjsController::class, 'rencanaKontrolDetail']);
Route::get('bpjs/rencanakontrol/noKP/{bulan}/{tahun}/{noKP}/{filter}', [BpjsController::class, 'rencanaKontrolNoKPDetail']);
Route::post('bpjs/report', [BpjsController::class, 'antreanReport']);