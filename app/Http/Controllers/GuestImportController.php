<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestImportController extends Controller
{
    public function create()
    {
        return view('guests.import');
    }

    public function store(Request $request)
    {
        // Validasi awal memastikan file wajib diunggah
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        // 1. Deteksi otomatis pemisah kolom (comma atau semicolon)
        $separator = ',';
        $fileHandleForCheck = fopen($filePath, 'r');
        $firstLine = fgets($fileHandleForCheck);
        fclose($fileHandleForCheck);
        
        if (strpos($firstLine, ';') !== false) {
            $separator = ';';
        }

        // 2. Proses membaca file
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            // Ambil baris pertama sebagai Header
            $header = fgetcsv($handle, 1000, $separator);

            // 🔥 PENGAMAN BARU: Cek validitas header
            // Mengubah semua tulisan di header menjadi huruf kecil semua biar aman dari typo
            $cleanHeader = array_map('strtolower', array_filter($header));

            // Jika kata 'nama' tidak ditemukan di baris paling atas, TOLAK!
            if (!in_array('nama', $cleanHeader)) {
                fclose($handle); // Tutup file dulu sebelum keluar
                return redirect()->back()->with('error', 'Gagal Import! Format file salah, kolom "Nama" tidak ditemukan.');
            }
            // 🔥 PENGAMAN SELESAI

            // Baca baris data satu per satu setelah lolos pemeriksaan header
            while (($data = fgetcsv($handle, 1000, $separator)) !== FALSE) {
                if (!empty($data[0])) { // Pastikan kolom nama tidak kosong
                    Guest::create([
                        'name'          => $data[0],
                        'invited_count' => isset($data[1]) ? (int)$data[1] : 1,
                        'category'      => isset($data[2]) ? $data[2] : 'Reguler',
                        'table_number'  => isset($data[3]) ? $data[3] : null,
                    ]);
                }
            }
            fclose($handle);

            return redirect()->route('guests.index')->with('success', 'Data tamu berhasil di-import dengan sukses!');
        }

        return redirect()->back()->with('error', 'Gagal membaca data file.');
    }
}