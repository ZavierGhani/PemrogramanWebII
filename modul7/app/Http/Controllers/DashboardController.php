<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMember     = Member::count();
        $totalBuku        = Buku::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::whereNull('tgl_kembali')->count();

        $peminjamanTerbaru = Peminjaman::with(['member', 'buku'])
            ->latest('tgl_pinjam')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMember',
            'totalBuku',
            'totalPeminjaman',
            'peminjamanAktif',
            'peminjamanTerbaru'
        ));
    }
}