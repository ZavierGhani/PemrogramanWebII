<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_member',
        'id_buku',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    protected $casts = [
        'tgl_pinjam'   => 'date',
        'tgl_kembali' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id_member');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }
}