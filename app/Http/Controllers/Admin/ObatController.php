<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Tampilkan daftar obat.
     */
    public function index()
    {
        $obats = Obat::orderBy('nama_obat')->get();

        return view('admin.obat.index', compact('obats'));
    }

    /**
     * Tampilkan form tambah obat.
     */
    public function create()
    {
        return view('admin.obat.create');
    }

    /**
     * Simpan obat baru.
     */
    // Validasi form 
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        Obat::create($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit obat.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);

        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Perbarui data obat.
     */
    // Validasi form
    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate($this->rules(), $this->messages());

        $obat->update($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Hapus data obat.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);

        try {
            $obat->delete();
        } catch (\Throwable $e) {
            report($e);

            return redirect()->route('obat.index')
                ->with('error', 'Data obat gagal dihapus karena sedang digunakan.');
        }

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }

    /**
     * Aturan validasi (dipakai store & update).
     */
    private function rules(): array
    {
        return [
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:35',
            'harga'     => 'required|integer|min:0',
        ];
    }

    private function messages(): array
    {
        return [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'nama_obat.max'      => 'Nama obat maksimal 255 karakter.',
            'kemasan.required'   => 'Kemasan wajib diisi.',
            'kemasan.max'        => 'Kemasan maksimal 35 karakter.',
            'harga.required'     => 'Harga wajib diisi.',
            'harga.integer'      => 'Harga harus berupa angka bulat.',
            'harga.min'          => 'Harga tidak boleh bernilai negatif.',
        ];
    }
}
