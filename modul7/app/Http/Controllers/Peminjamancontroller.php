<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Member;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman, dengan fitur search via ?q=
     * Search berdasarkan nama member atau judul buku.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $peminjamans = Peminjaman::query()
            ->with(['member', 'buku'])
            ->when($q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->whereHas('member', function ($m) use ($q) {
                            $m->where('nama_member', 'like', "%{$q}%");
                        })
                        ->orWhereHas('buku', function ($b) use ($q) {
                            $b->where('judul', 'like', "%{$q}%");
                        });
                });
            })
            ->latest('tgl_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjamans', 'q'));
    }

    /**
     * Form tambah peminjaman.
     */
    public function create()
    {
        $members = Member::orderBy('nama_member')->get();
        $bukus   = Buku::orderBy('judul')->get();

        return view('peminjaman.create', compact('members', 'bukus'));
    }

    /**
     * Simpan peminjaman baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_member'    => ['required', 'exists:members,id_member'],
            'id_buku'      => ['required', 'exists:bukus,id'],
            'tgl_pinjam'   => ['required', 'date'],
            'tgl_kembali' => ['nullable', 'date', 'after_or_equal:tgl_pinjam'],
        ], [
            'id_member.required'         => 'Member wajib dipilih.',
            'id_member.exists'           => 'Member yang dipilih tidak valid.',
            'id_buku.required'           => 'Buku wajib dipilih.',
            'id_buku.exists'             => 'Buku yang dipilih tidak valid.',
            'tgl_pinjam.required'        => 'Tanggal pinjam wajib diisi.',
            'tgl_pinjam.date'            => 'Tanggal pinjam harus berupa tanggal yang valid.',
            'tgl_kembali.date'           => 'Tanggal kembali harus berupa tanggal yang valid.',
            'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail peminjaman.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['member', 'buku'])->findOrFail($id);

        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Form edit peminjaman.
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $members     = Member::orderBy('nama_member')->get();
        $bukus       = Buku::orderBy('judul')->get();

        return view('peminjaman.edit', compact('peminjaman', 'members', 'bukus'));
    }

    /**
     * Update data peminjaman.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'id_member'    => ['required', 'exists:members,id_member'],
            'id_buku'      => ['required', 'exists:bukus,id'],
            'tgl_pinjam'   => ['required', 'date'],
            'tgl_kembali' => ['nullable', 'date', 'after_or_equal:tgl_pinjam'],
        ], [
            'id_member.required'         => 'Member wajib dipilih.',
            'id_member.exists'           => 'Member yang dipilih tidak valid.',
            'id_buku.required'           => 'Buku wajib dipilih.',
            'id_buku.exists'             => 'Buku yang dipilih tidak valid.',
            'tgl_pinjam.required'        => 'Tanggal pinjam wajib diisi.',
            'tgl_pinjam.date'            => 'Tanggal pinjam harus berupa tanggal yang valid.',
            'tgl_kembali.date'           => 'Tanggal kembali harus berupa tanggal yang valid.',
            'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Hapus peminjaman.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }
}