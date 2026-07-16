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
        $request->validate([
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        // 1. Deteksi otomatis pemisah kolom
        $separator = ',';
        $fileHandleForCheck = fopen($filePath, 'r');
        $firstLine = fgets($fileHandleForCheck);
        fclose($fileHandleForCheck);
        
        if (strpos($firstLine, ';') !== false) {
            $separator = ';';
        }

        // 2. Proses membaca file
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            // Lewati baris pertama (Header: Nama, Kuota, Kategori, Meja)
            fgetcsv($handle, 1000, $separator);

            // Baca baris data satu per satu
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