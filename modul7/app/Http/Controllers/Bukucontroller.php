<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Tampilkan daftar buku, dengan fitur search via ?q=
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $bukus = Buku::query()
            ->when($q, function ($query, $q) {
                $query->where('judul', 'like', "%{$q}%")
                      ->orWhere('penulis', 'like', "%{$q}%")
                      ->orWhere('penerbit', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('buku.index', compact('bukus', 'q'));
    }

    /**
     * Form tambah buku.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Simpan buku baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'         => ['required', 'string', 'max:500'],
            'penulis'       => ['required', 'string', 'max:500'],
            'penerbit'      => ['required', 'string', 'max:250'],
            'tahun_terbit' => ['required', 'integer', 'min:1801', 'max:2023'],
            'cover'         => ['nullable', 'image', 'max:2048'],
        ], [
            'judul.required'         => 'Judul wajib diisi.',
            'judul.string'           => 'Judul harus berupa teks.',
            'penulis.required'       => 'Nama penulis wajib diisi.',
            'penulis.string'         => 'Nama penulis harus berupa teks.',
            'penerbit.required'      => 'Nama penerbit wajib diisi.',
            'penerbit.string'        => 'Nama penerbit harus berupa teks.',
            'tahun_terbit.required'  => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer'   => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min'       => 'Tahun terbit harus lebih besar dari 1800.',
            'tahun_terbit.max'       => 'Tahun terbit harus lebih kecil dari 2024.',
            'cover.image'            => 'Cover harus berupa gambar.',
            'cover.max'              => 'Ukuran cover maksimal 2MB.',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail buku.
     */
    public function show($id)
    {
        $buku = Buku::with('peminjamans.member')->findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    /**
     * Form edit buku.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    /**
     * Update data buku.
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'judul'         => ['required', 'string', 'max:500'],
            'penulis'       => ['required', 'string', 'max:500'],
            'penerbit'      => ['required', 'string', 'max:250'],
            'tahun_terbit' => ['required', 'integer', 'min:1801', 'max:2023'],
            'cover'         => ['nullable', 'image', 'max:2048'],
        ], [
            'judul.required'         => 'Judul wajib diisi.',
            'judul.string'           => 'Judul harus berupa teks.',
            'penulis.required'       => 'Nama penulis wajib diisi.',
            'penulis.string'         => 'Nama penulis harus berupa teks.',
            'penerbit.required'      => 'Nama penerbit wajib diisi.',
            'penerbit.string'        => 'Nama penerbit harus berupa teks.',
            'tahun_terbit.required'  => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer'   => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min'       => 'Tahun terbit harus lebih besar dari 1800.',
            'tahun_terbit.max'       => 'Tahun terbit harus lebih kecil dari 2024.',
            'cover.image'            => 'Cover harus berupa gambar.',
            'cover.max'              => 'Ukuran cover maksimal 2MB.',
        ]);

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Hapus buku.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}