<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Tampilkan daftar member, dengan fitur search via ?q=
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $members = Member::query()
            ->when($q, function ($query, $q) {
                $query->where('nama_member', 'like', "%{$q}%")
                      ->orWhere('nomor_member', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('member.index', compact('members', 'q'));
    }

    /**
     * Form tambah member.
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Simpan member baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_member'         => ['required', 'string', 'max:250'],
            'nomor_member'        => ['required', 'string', 'max:15'],
            'alamat'               => ['required', 'string'],
            'tgl_mendaftar'       => ['required', 'date'],
            'tgl_terkahir_bayar' => ['nullable', 'date'],
            'foto'                 => ['nullable', 'image', 'max:2048'],
        ], [
            'nama_member.required'   => 'Nama member wajib diisi.',
            'nomor_member.required'  => 'Nomor member wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'tgl_mendaftar.required'  => 'Tanggal mendaftar wajib diisi.',
            'tgl_mendaftar.date'      => 'Tanggal mendaftar harus berupa tanggal yang valid.',
            'tgl_terkahir_bayar.date' => 'Tanggal terakhir bayar harus berupa tanggal yang valid.',
            'foto.image'               => 'Foto harus berupa gambar.',
            'foto.max'                 => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto-member', 'public');
        }

        Member::create($validated);

        return redirect()->route('member.index')
            ->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail member.
     */
    public function show($id)
    {
        $member = Member::with('peminjamans.buku')->findOrFail($id);

        return view('member.show', compact('member'));
    }

    /**
     * Form edit member.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);

        return view('member.edit', compact('member'));
    }

    /**
     * Update data member.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'nama_member'         => ['required', 'string', 'max:250'],
            'nomor_member'        => ['required', 'string', 'max:15'],
            'alamat'               => ['required', 'string'],
            'tgl_mendaftar'       => ['required', 'date'],
            'tgl_terkahir_bayar' => ['nullable', 'date'],
            'foto'                 => ['nullable', 'image', 'max:2048'],
        ], [
            'nama_member.required'   => 'Nama member wajib diisi.',
            'nomor_member.required'  => 'Nomor member wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'tgl_mendaftar.required'  => 'Tanggal mendaftar wajib diisi.',
            'tgl_mendaftar.date'      => 'Tanggal mendaftar harus berupa tanggal yang valid.',
            'tgl_terkahir_bayar.date' => 'Tanggal terakhir bayar harus berupa tanggal yang valid.',
            'foto.image'               => 'Foto harus berupa gambar.',
            'foto.max'                 => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto-member', 'public');
        }

        $member->update($validated);

        return redirect()->route('member.index')
            ->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Hapus member.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        $member->delete();

        return redirect()->route('member.index')
            ->with('success', 'Member berhasil dihapus.');
    }
}