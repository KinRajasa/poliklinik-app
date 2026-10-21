<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        // Hanya menampilkan jadwal dokter yang sedang login
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())->get();
        return view('dokter.jadwal-periksa.index', compact('jadwal'));
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    // Validasi form 
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'Aktif' // default
        ]);

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)->where('id_dokter', Auth::id())->firstOrFail();
        return view('dokter.jadwal-periksa.edit', compact('jadwal'));
    }

    // Validasi form 
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|string'
        ]);

        $jadwal = JadwalPeriksa::where('id', $id)->where('id_dokter', Auth::id())->firstOrFail();
        $jadwal->update($request->only(['hari', 'jam_mulai', 'jam_selesai', 'status']));

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)->where('id_dokter', Auth::id())->firstOrFail();
        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}