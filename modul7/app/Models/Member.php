<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $primaryKey = 'id_member';

    protected $fillable = [
        'nama_member',
        'nomor_member',
        'alamat',
        'foto',
        'tgl_mendaftar',
        'tgl_terkahir_bayar',
    ];

    protected $casts = [
        'tgl_mendaftar'       => 'datetime',
        'tgl_terkahir_bayar' => 'date',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_member', 'id_member');
    }
}