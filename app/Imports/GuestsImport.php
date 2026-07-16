<?php

namespace App\Imports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class GuestsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        return new Guest([
            'name'          => trim($row['nama']),
            'invited_count' => (int) ($row['kuota_undangan'] ?? 1), 
            'phone'         => $row['telepon'] ?? null, // Tetap aman jika nanti ada kolom telepon di Excel
            'category'      => $row['kategori'] ?? null,
            'table_number'  => $row['no_meja'] ?? null, 
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'kuota_undangan' => ['nullable', 'integer', 'min:1'], 
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'nama.required' => 'Kolom "nama" wajib diisi di setiap baris.',
        ];
    }
}