<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SouvenirTicket; 

class SouvenirRedemptionController extends Controller
{
    // Tampilkan halaman meja souvenir
    public function index()
    {
        return view('souvenir.redemption_desk');
    }

    // Eksekusi penukaran kupon
    public function redeem(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string',
        ]);

        // 1. Cari tiket berdasarkan kodenya
        $ticket = SouvenirTicket::where('ticket_code', $request->ticket_code)->first();

        if (!$ticket) {
            return redirect()->back()->with([
                'error' => 'Kode tiket tidak valid atau tidak ditemukan.',
                'audio_status' => 'error'
            ]);
        }

        // 2. CEK DUPLIKAT: Cek apakah kolom 'is_redeemed' bernilai true/1
        if ($ticket->is_redeemed == true || $ticket->is_redeemed == 1) { 
            
            // Cek nama tamu secara aman agar kodingan tidak crash jika belum buat relasi
            $namaTamu = 'Tamu';
            if (method_exists($ticket, 'guest') && $ticket->guest) {
                $namaTamu = $ticket->guest->name;
            }
            
            $waktuTukar = $ticket->updated_at ? $ticket->updated_at->timezone('Asia/Jakarta')->format('H:i:s') : '-';

            return redirect()->back()->with([
                'error' => "Tiket ini sudah pernah ditukarkan oleh [ {$namaTamu} ] pada pukul {$waktuTukar} WIB.",
                'audio_status' => 'error'
            ]);
        }

        // 3. PROSES SIMPAN: Ubah nilai is_redeemed menjadi true
        $ticket->is_redeemed = true; 
        $ticket->save(); 

        // Ambil nama tamu untuk notifikasi sukses
        $namaTamu = 'Tamu';
        if (method_exists($ticket, 'guest') && $ticket->guest) {
            $namaTamu = $ticket->guest->name;
        }

        return redirect()->back()->with([
            'success' => "Souvenir ke-{$ticket->ticket_code} atas nama [ {$namaTamu} ] berhasil diverifikasi.",
            'audio_status' => 'success'
        ]);
    }
}