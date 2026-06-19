<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Member;
use App\Models\Buku;
use App\Models\Peminjaman;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== User Admin =====
        User::create([
            'username' => 'admin',
            'email'    => 'admin@slytherin.test',
            'password' => Hash::make('password'),
        ]);

        // ===== Members =====
        $members = [
            ['nama_member' => 'Draco Malfoy',        'nomor_member' => 'SLY-0001', 'alamat' => 'Malfoy Manor, Wiltshire',           'tgl_mendaftar' => now()->subDays(120), 'tgl_terkahir_bayar' => now()->subDays(10)],
            ['nama_member' => 'Pansy Parkinson',      'nomor_member' => 'SLY-0002', 'alamat' => 'Parkinson Estate, London',          'tgl_mendaftar' => now()->subDays(110), 'tgl_terkahir_bayar' => now()->subDays(3)],
            ['nama_member' => 'Blaise Zabini',        'nomor_member' => 'SLY-0003', 'alamat' => 'Villa Zabini, Florence',            'tgl_mendaftar' => now()->subDays(100), 'tgl_terkahir_bayar' => now()->subDays(7)],
            ['nama_member' => 'Theodore Nott',        'nomor_member' => 'SLY-0004', 'alamat' => 'Nott Tower, Edinburgh',             'tgl_mendaftar' => now()->subDays(95),  'tgl_terkahir_bayar' => now()->subDays(14)],
            ['nama_member' => 'Millicent Bulstrode',  'nomor_member' => 'SLY-0005', 'alamat' => 'Bulstrode Keep, Yorkshire',         'tgl_mendaftar' => now()->subDays(90),  'tgl_terkahir_bayar' => now()->subDays(5)],
            ['nama_member' => 'Gregory Goyle',        'nomor_member' => 'SLY-0006', 'alamat' => 'Goyle Fortress, Wales',             'tgl_mendaftar' => now()->subDays(85),  'tgl_terkahir_bayar' => now()->subDays(20)],
            ['nama_member' => 'Vincent Crabbe',       'nomor_member' => 'SLY-0007', 'alamat' => 'Crabbe Hall, Bristol',              'tgl_mendaftar' => now()->subDays(80),  'tgl_terkahir_bayar' => now()->subDays(30)],
            ['nama_member' => 'Daphne Greengrass',    'nomor_member' => 'SLY-0008', 'alamat' => 'Greengrass Manor, Wiltshire',       'tgl_mendaftar' => now()->subDays(75),  'tgl_terkahir_bayar' => now()->subDays(2)],
            ['nama_member' => 'Astoria Greengrass',   'nomor_member' => 'SLY-0009', 'alamat' => 'Greengrass Manor, Wiltshire',       'tgl_mendaftar' => now()->subDays(70),  'tgl_terkahir_bayar' => now()->subDays(8)],
            ['nama_member' => 'Marcus Flint',         'nomor_member' => 'SLY-0010', 'alamat' => 'Flint Keep, Cornwall',              'tgl_mendaftar' => now()->subDays(65),  'tgl_terkahir_bayar' => now()->subDays(45)],
            ['nama_member' => 'Adrian Pucey',         'nomor_member' => 'SLY-0011', 'alamat' => 'Pucey Estate, Kent',                'tgl_mendaftar' => now()->subDays(60),  'tgl_terkahir_bayar' => now()->subDays(12)],
            ['nama_member' => 'Lucian Bole',          'nomor_member' => 'SLY-0012', 'alamat' => 'Bole Manor, Suffolk',               'tgl_mendaftar' => now()->subDays(55),  'tgl_terkahir_bayar' => now()->subDays(18)],
            ['nama_member' => 'Tracey Davis',         'nomor_member' => 'SLY-0013', 'alamat' => 'Davis Residence, Oxford',           'tgl_mendaftar' => now()->subDays(50),  'tgl_terkahir_bayar' => now()->subDays(1)],
            ['nama_member' => 'Severus Snape',        'nomor_member' => 'SLY-0014', 'alamat' => 'Spinner\'s End, Cokeworth',         'tgl_mendaftar' => now()->subDays(200), 'tgl_terkahir_bayar' => now()->subDays(60)],
            ['nama_member' => 'Lucius Malfoy',        'nomor_member' => 'SLY-0015', 'alamat' => 'Malfoy Manor, Wiltshire',           'tgl_mendaftar' => now()->subDays(300), 'tgl_terkahir_bayar' => now()->subDays(90)],
        ];

        $createdMembers = [];
        foreach ($members as $data) {
            $createdMembers[] = Member::create($data);
        }

        // ===== Buku =====
        $bukus = [
            ['judul' => 'Secrets of the Darkest Art',         'penulis' => 'Owle Bullock',          'penerbit' => 'Obscurus Books',              'tahun_terbit' => 1723],
            ['judul' => 'Magick Moste Evile',                 'penulis' => 'Godelot',               'penerbit' => 'Flourish & Blotts',           'tahun_terbit' => 1542],
            ['judul' => 'Moste Potente Potions',              'penulis' => 'Phyllida Spore',         'penerbit' => 'Diagon Alley Publishing',     'tahun_terbit' => 1901],
            ['judul' => 'Ye Olde Destructive Spelles',        'penulis' => 'Arcanus Vex',            'penerbit' => 'Knockturn Press',             'tahun_terbit' => 1388],
            ['judul' => 'The Dark Arts Outsmarted',           'penulis' => 'Brutus Scrimgeour',      'penerbit' => 'Ministry Archives',           'tahun_terbit' => 1845],
            ['judul' => 'Poisons Most Foul',                  'penulis' => 'Hector Podmore',         'penerbit' => 'Black Library Press',         'tahun_terbit' => 1601],
            ['judul' => 'Nature\'s Nobility: A Wizarding Genealogy', 'penulis' => 'Perseus Black',  'penerbit' => 'Pure Blood Press',            'tahun_terbit' => 1966],
            ['judul' => 'Flesh, Blood and Bone',              'penulis' => 'Salazar Slytherin',      'penerbit' => 'Restricted Section Archives', 'tahun_terbit' => 993],
            ['judul' => 'Haunt of the Dark Creatures',        'penulis' => 'Mordecai Belacroix',     'penerbit' => 'Nocturne Publishing',         'tahun_terbit' => 1777],
            ['judul' => 'Curses and Counter-Curses',          'penulis' => 'Professor Vindictus Viridian', 'penerbit' => 'Hogwarts Press',       'tahun_terbit' => 1912],
            ['judul' => 'The Invisible Book of Invisibility', 'penulis' => 'Anonymous',              'penerbit' => 'Unknown',                     'tahun_terbit' => 1800],
            ['judul' => 'Sonnets of a Sorcerer',              'penulis' => 'Corvinus Gaunt',         'penerbit' => 'Gaunt Family Archives',       'tahun_terbit' => 1650],
            ['judul' => 'Blood Rites of the Ancient Ones',   'penulis' => 'Narcissa Black',         'penerbit' => 'Black Family Press',          'tahun_terbit' => 1955],
            ['judul' => 'Dark Creatures: A Bestiary',         'penulis' => 'Eustace Montague',       'penerbit' => 'Knockturn Press',             'tahun_terbit' => 1834],
            ['judul' => 'Occlumency: The Hidden Mind',        'penulis' => 'Severus Snape',          'penerbit' => 'Hogwarts Restricted Press',   'tahun_terbit' => 1981],
        ];

        $createdBukus = [];
        foreach ($bukus as $data) {
            $createdBukus[] = Buku::create($data);
        }

        // ===== Peminjaman =====
        $peminjamans = [
            ['member' => 0,  'buku' => 0,  'pinjam' => now()->subDays(5),  'kembali' => null],
            ['member' => 1,  'buku' => 1,  'pinjam' => now()->subDays(15), 'kembali' => now()->subDays(1)],
            ['member' => 2,  'buku' => 2,  'pinjam' => now()->subDays(10), 'kembali' => null],
            ['member' => 3,  'buku' => 3,  'pinjam' => now()->subDays(20), 'kembali' => now()->subDays(5)],
            ['member' => 4,  'buku' => 4,  'pinjam' => now()->subDays(8),  'kembali' => null],
            ['member' => 5,  'buku' => 5,  'pinjam' => now()->subDays(30), 'kembali' => now()->subDays(10)],
            ['member' => 6,  'buku' => 6,  'pinjam' => now()->subDays(3),  'kembali' => null],
            ['member' => 7,  'buku' => 7,  'pinjam' => now()->subDays(45), 'kembali' => now()->subDays(20)],
            ['member' => 8,  'buku' => 8,  'pinjam' => now()->subDays(7),  'kembali' => null],
            ['member' => 9,  'buku' => 9,  'pinjam' => now()->subDays(12), 'kembali' => now()->subDays(2)],
            ['member' => 10, 'buku' => 10, 'pinjam' => now()->subDays(2),  'kembali' => null],
            ['member' => 11, 'buku' => 11, 'pinjam' => now()->subDays(60), 'kembali' => now()->subDays(30)],
            ['member' => 12, 'buku' => 12, 'pinjam' => now()->subDays(1),  'kembali' => null],
            ['member' => 13, 'buku' => 13, 'pinjam' => now()->subDays(90), 'kembali' => now()->subDays(60)],
            ['member' => 14, 'buku' => 14, 'pinjam' => now()->subDays(4),  'kembali' => null],
        ];

        foreach ($peminjamans as $p) {
            Peminjaman::create([
                'id_member'   => $createdMembers[$p['member']]->id_member,
                'id_buku'     => $createdBukus[$p['buku']]->id,
                'tgl_pinjam'  => $p['pinjam'],
                'tgl_kembali' => $p['kembali'],
            ]);
        }
    }
}