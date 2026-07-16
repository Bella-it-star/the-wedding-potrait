<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestCheckin;
use App\Models\SouvenirTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::query()->withCount('souvenirTickets')->with(['checkin', 'souvenirTickets']);

        if ($search = $request->get('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $guests = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('guests.index', compact('guests', 'search'));
    }

    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        // Aturan validasi disamakan dengan update
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'invited_count' => ['required', 'integer', 'min:1'],
            'phone'         => ['nullable', 'string', 'max:30'],
            'category'      => ['nullable', 'string', 'max:100'],
            'table_number'  => ['nullable', 'string', 'max:30'],
            'notes'         => ['nullable', 'string'],
        ]);

        Guest::create($data);

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        // Format validasi disamakan menggunakan Array agar konsisten dengan store
        $validatedData = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'invited_count' => ['required', 'integer', 'min:1'],
            'phone'         => ['nullable', 'string', 'max:30'],
            'category'      => ['nullable', 'string', 'max:100'],
            'table_number'  => ['nullable', 'string', 'max:30'],
            'notes'         => ['nullable', 'string'],
        ]);

        $guest->update($validatedData);

        return redirect()->route('guests.index')->with('success', 'Data tamu ' . $guest->name . ' berhasil diperbarui!');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil dihapus.');
    }

    // Mengubah $id menjadi Guest $guest agar konsisten menggunakan Route Model Binding
    public function checkin(Request $request, Guest $guest)
    {
        // Bypass User Terotomatisasi
        $user = DB::table('users')->first();
        if (!$user) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Admin Usher',
                'email' => 'admin@wedding.com',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $user->id;
        }

        $attendedCount = $request->input('attended_count', 1);

        // Membungkus proses dengan Transaction agar aman dari data korup/setengah simpan
        DB::transaction(function () use ($guest, $attendedCount, $userId) {
            $checkin = GuestCheckin::forceCreate([
                'guest_id'       => $guest->id,
                'attended_count' => $attendedCount,
                'checked_in_by'  => auth()->id() ?? $userId, 
                'checked_in_at'  => now(),
            ]);

            for ($i = 0; $i < $attendedCount; $i++) {
                SouvenirTicket::create([
                    'guest_id'          => $guest->id,
                    'guest_checkin_id'  => $checkin->id,
                    'ticket_code'       => 'SVR-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6)),
                    'status'            => 'unused'
                ]);
            }
        });

        return redirect()->route('guests.index')->with([
            'success' => 'Check-in berhasil untuk ' . $guest->name . '!'
        ]);
    }
}