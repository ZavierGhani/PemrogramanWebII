<?php

namespace App\Models;

class Portfolio
{
    public static function getProfil()
    {
        return [
            'nama' => 'Zavier Putra Nata Ghani',
            'nim' => '2410817210014',
            'prodi' => 'Teknologi Informasi',
            'foto' => asset('images/Zavier.jpeg'),
            'hobi' => [
                'Mengulik Film',
                'Mengulik Musik',
                'Membaca Buku',
                'Berolahraga',
            ],
            'skill' => [
                'HTML', 'CSS', 'JavaScript', 'Python',
                'Laravel', 'Git', 'Figma', 'SQL',
            ],
        ];
    }

    public static function getPengalaman()
    {
        return [
            [
                'id' => 1,
                'judul' => 'Hackathon Nasional GEMASTIK',
                'singkat' => 'Kompetisi teknologi tingkat nasional antar mahasiswa.',
                'waktu' => 'Oktober 2027',
                'deskripsi' => 'Bersama tim beranggotakan 3 orang, kami mengembangkan aplikasi manajemen sampah berbasis IoT dalam waktu 48 jam. Proses yang intens namun sangat membangun kemampuan problem-solving dan kerja tim di bawah tekanan.',
                'kesan' => 'Pengalaman pertama berkompetisi di level nasional. Deg-degan, exhausted, tapi proud banget, kami berhasil masuk top 10 finalis.',
                'foto' =>  asset('images/gemastik.jpeg'),
            ],
            [
                'id' => 2,
                'judul' => 'PKM — Program Kreativitas Mahasiswa',
                'singkat' => 'Riset dan inovasi teknologi didanai Kemdikbud.',
                'waktu' => 'Maret 2024',
                'deskripsi' => 'Mengajukan proposal PKM-KC (Karsa Cipta) tentang sistem monitoring kualitas udara berbasis machine learning untuk kawasan perkotaan. Melewati proses seleksi ketat, revisi berkali-kali, hingga akhirnya proposal kami lolos pendanaan.',
                'kesan' => 'Belajar bahwa riset itu bukan soal hasil akhir saja — prosesnya yang bikin tumbuh. Bisa kolaborasi lintas disiplin ilmu adalah privilege.',
                'foto' =>  asset('images/pkm.jpeg'),
            ],
            [
                'id' => 3,
                'judul' => 'KODE 2026 — Lomba Debat Bahasa Inggris Kalimantan Selatan',
                'singkat' => 'Event debat terbesar dalam lingkup Kalsel.',
                'waktu' => 'Agustus 2026',
                'deskripsi' => 'Menjadi koordinator divisi logistik dalam penyelenggaraan lomba debat bahasa Inggris yang diikuti peserta dari berbagai sekolah dan perguruan tinggi di Kalimantan Selatan. Bertanggung jawab memastikan kebutuhan acara tersedia dan terdistribusi dengan baik, mulai dari perlengkapan lomba, kebutuhan peserta, hingga koordinasi dengan divisi lain selama acara berlangsung.',
                'kesan' => 'Terlibat langsung dalam persiapan dan pelaksanaan acara bersama tim dari berbagai divisi. Pengalaman ini memberi gambaran yang lebih nyata tentang pentingnya koordinasi dan pengelolaan detail dalam sebuah kegiatan berskala besar.',
                'foto' =>  asset('images/debat.jpg'),
            ],
            [
                'id' => 4,
                'judul' => 'Pengurus TEDxULM',
                'singkat' => 'Bagian dari tim penyelenggara TEDxULM',
                'waktu' => 'Januari 2027',
                'deskripsi' => 'Bergabung dalam divisi acara yang bertugas membantu perencanaan dan pelaksanaan rangkaian kegiatan TEDxULM. Terlibat dalam koordinasi teknis acara, penyusunan alur sesi, komunikasi dengan pembicara, serta memastikan setiap sesi berjalan sesuai jadwal yang telah dirancang.',
                'kesan' => 'Menarik melihat bagaimana sebuah acara besar dibangun dari banyak detail kecil yang sering tidak terlihat oleh peserta. Pengalaman ini membuat saya lebih memahami pentingnya kolaborasi, persiapan yang matang, dan kerja di balik layar yang menentukan suksesnya sebuah acara',
                'foto' =>  asset('images/tedxulm.jpg'),
            ],
        ];
    }

    public static function getFilm()
    {
        return [
            [
                'judul'       => 'Dead Poets Society',
                'tahun'       => 1989,
                'sutradara'   => 'Peter Weir',
                'genre'       => ['coming-of-age', 'Drama', 'Classic'],
                'rating'      => '9.8',
                'poster'      => asset('images/dps.webp'),     
                'trailer_id'  => 'ye4KFyWu2do',              
                'why'         => 'Film yang mengingatkan aku bahwa kata-kata, kalau disampaikan dengan tepat, bisa mengubah seseorang selamanya.',
                'ulasan'      => 'Ada momen di Dead Poets Society yang bikin napas tertahan. Bukan karena kejutannya, tapi karena terasa terlalu familier. Peter Weir membangun ceritanya pelan, seperti orang yang tahu betul kapan harus diam dan kapan harus bicara. Sang aktor utama, Robin Williams, membawa sesuatu yang berbeda di sini, kehangatan yang nggak dibuat-buat. Dan ketika semuanya perlahan runtuh di babak akhir, kamu nggak merasakan marah, nggak kaget. Kamu cuma duduk, dan merasakan beratnya.',
            ],
            [
                'judul'       => 'Tenet',
                'tahun'       => 2020,
                'sutradara'   => 'Christopher Nolan',
                'genre'       => ['Sci-Fi', 'Action', 'Adventure'],
                'rating'      => '9.7',
                'poster'      => asset('images/tenet.jpeg'), 
                'trailer_id'  => '4xj0KRqzo-0',             
                'why'         => 'Satu-satunya film yang bikin aku pause, rewind, pause lagi, dan tetap kagum meski nggak paham.',
                'ulasan'      => 'Tenet bukan film yang bisa dijelasin dalam satu kalimat. Nolan membangun dunia yang bergerak maju dan mundur secara harfiah, dan entah bagaimana semuanya tetap terasa kohesif. Banyak orang bilang filmnya terlalu dingin, terlalu cerebral. Mungkin iya. Tapi ada sesuatu di cara Nolan menyusun setiap adegannya yang bikin kamu nggak bisa berhenti mikir bahkan setelah selesai nonton. Ludwig Göransson ngisi scorenya dengan sesuatu yang terasa seperti tekanan konstan di dada. Dan itu justru yang bikin Tenet susah dilupain. Setelah nonton, coba luangin waktu buat ngulik science di baliknya, karena begitu kamu ngerti, kamu akan appreciate film ini dengan cara yang sama sekali berbeda.',

            ],
            [
                'judul'       => 'Stand By Me',
                'tahun'       => 1986,
                'sutradara'   => 'Rob Reiner',
                'genre'       => ['Drama', 'Coming-of-age', 'Comedy'],
                'rating'      => '9.3',
                'poster'      => asset('images/sbm.jpg'),
                'trailer_id'  => 'jaiZ6ZQoO-Y',             
                'why'         => 'Film yang sederhana di permukaan, tapi ninggalin sesuatu yang susah dijelasin lama setelah selesai.',
                'ulasan'      => 'Stand By Me adalah salah satu film yang paling susah aku jelasin kenapa bagus. Ceritanya nggak complicated, nggak ada twist besar, nggak ada yang berlebihan. Rob Reiner mengambil sesuatu yang sederhana, empat anak, satu misi, satu akhir pekan, dan entah bagaimana mengubahnya jadi sesuatu yang terasa seperti obituari untuk masa kecil. Setiap adegannya disusun dengan cara yang bikin kamu nggak mau buru-buru. Semuanya terasa seperti ingatan, bukan film. Dan film ini ngingetin aku bahwa kadang satu perjalanan kecil, bisa mengubah arah hidup seseorang lebih dari yang mereka sadari.',
            ],

              [
                'judul'       => 'The Starling',
                'tahun'       => 2021,
                'sutradara'   => 'Theodore Melfi',
                'genre'       => ['Comedy', 'Drama', 'Melodrama'],
                'rating'      => '9.1',
                'poster'      => asset('images/thestarling.jpg'),
                'trailer_id'  => 'fYyImx_KXm4',             
                'why'         => 'My comfort movie, film yang selalu aku balik lagi ketika butuh sesuatu yang tenang.',
                'ulasan'      => 'The Starling bukan film yang ramai dibicarakan, dan aku nggak kaget. Ceritanya straightforward, nggak ada yang crazy dari segi plot atau akting. Tapi footage-nya genuinely insane. Theodore Melfi entah bagaimana tahu cara membuat setiap shot terasa seperti ada sesuatu yang worth buat dilihat, bahkan di momen yang paling biasa sekalipun. Setiap frame terasa dipikirkan, nggak ada yang kebetulan. Dan Benjamin Wallfisch melakukan hal yang sama lewat musiknya. Scoring dan pilihan lagunya di film ini bukan yang paling megah, tapi yang paling terasa pas, sampai beberapa lagunya sekarang jadi lagu favorit aku yang aku putar terus tanpa bosan. The Starling adalah comfort movie aku. Film yang selalu aku balik lagi bukan karena ceritanya, tapi karena ada sesuatu di dalamnya yang selalu berhasil bikin segalanya terasa sedikit lebih ringan.',
            ],

              [
                'judul'       => 'Janji Joni',
                'tahun'       => 2005,
                'sutradara'   => 'Joko Anwar',
                'genre'       => ['Romantic Comedy', 'Drama', 'Adventure'],
                'rating'      => '9.0',
                'poster'      => asset('images/janjijoni.jpg'),
                'trailer_id'  => 'Fe6-TV79Z4k',             
                'why'         => 'Bukti bahwa premis yang simpel, di tangan yang tepat, bisa jadi perjalanan yang genuinely menyenangkan.',
                'ulasan'      => ' Janji Joni adalah film yang nggak perlu banyak untuk jadi menarik. Premisnya sederhana banget, seorang kurir film yang harus memastikan rol filmnya sampai tepat waktu dari satu bioskop ke bioskop lain. Itu saja. Tapi Joko Anwar tahu betul cara mengambil sesuatu yang kecil dan membuatnya terasa hidup. Ada energy di film ini yang susah dijelasin, ringan tapi nggak pernah terasa kosong. Dan melihat ini sebagai salah satu film awal Joko Anwar, kamu bisa ngerti kenapa ia jadi salah satu sutradara paling penting yang pernah dimiliki sinema Indonesia.',
            ],
        ];
    }
public static function getSeries()
{
    return [
        [
            'judul'      => 'Anne With an E',
            'tahun'      => 2017,
            'season'     => 3,
            'status'     => 'Ended',
            'genre'      => ['coming-of-age ', 'Period Drama', 'Social Drama'],
            'rating'     => '9.8',
            'poster'     => asset('images/anne.jpeg'),
            'trailer_id' => 'S5qJXYNNINo',
            'why'        => 'Series yang cantik di permukaan, tapi makin dalam makin terasa berat, dan makin berat makin susah berhenti.',
            'ulasan'     => 'Susah menjelaskan Anne With an E tanpa terdengar berlebihan. Footage-nya indah, scoring-nya terasa pas, tapi yang paling bikin series ini berbekas adalah Anne-nya sendiri, karakter yang susah untuk tidak dicintai dan susah untuk tidak belajar sesuatu darinya. Tiga season yang masing-masing punya bobotnya sendiri, dan setiap episode selalu ninggalin sesuatu. Tentang belonging, tentang identitas, tentang keberanian untuk tetap jadi dirimu sendiri di dunia yang terus menerus memintamu untuk jadi orang lain. Footage-nya genuinely beautiful, setiap episode terasa seperti lukisan yang bergerak. Dan lesson of life yang tersebar di sepanjang tiga season-nya nggak pernah bikin berhenti tersenyum dan kembali bernafas.',
        ],
        [
            'judul'      => 'Derry Girls',
            'tahun'      => 2018,
            'season'     => 3,
            'status'     => 'Ended',
            'genre'      => ['Teen Sitcom', 'Coming-of-Age', 'Historical Comedy'],
            'rating'     => '9.7',
            'poster'     => asset('images/derrygirls.jpeg'),
            'trailer_id' => 'UFmFuXH0IRY',
            'why'        => 'Series yang per episodenya aku tonton berkali-kali dan masih sama lucunya, tapi finalenya bikin aku diam lebih lama dari yang aku kira.',
            'ulasan'     => 'Derry Girls adalah series yang genuinely lucu, bukan lucu yang dipaksakan, tapi lucu yang terasa natural dan bodoh dan sangat manusiawi sekaligus. Setiap episode bisa aku tonton berkali-kali dan masih ketawa di bagian yang sama. Tapi yang nggak aku sangka adalah finalenya. Series ini ditutup dengan cara yang bikin semua yang tadinya terasa ringan tiba-tiba punya bobot yang berbeda. Ada melankoli yang pelan-pelan masuk, Series ini ditutup dengan cara yang bikin semua yang tadinya terasa seperti hiburan tiba-tiba jadi sesuatu yang sangat personal. Ada pesan yang disampaikan di episode terakhir itu tentang hidup, tentang moving on, tentang hal-hal yang harus berakhir supaya yang lain bisa dimulai. Dan itu ninggalin ruang kosong yang susah diisi. Tipe series yang kamu nggak mau selesai, tapi kamu tahu harus.',
        ],
        [
            'judul'      => 'The Witcher',
            'tahun'      => 2019,
            'season'     => 4,
            'status'     => 'Ongoing',
            'genre'      => ['Dark Fantasy', 'Action-Adventure', 'Political Thriller'],
            'rating'     => '9.3',
            'poster'     => asset('images/thewitcher.jpeg'),
            'trailer_id' => '8rtQugKDvGY',
            'why'        => ' Henry Cavill sebagai Geralt adalah salah satu casting terbaik yang pernah aku lihat, dan series ini membuktikan kenapa.',
            'ulasan'     => ' The Witcher punya semua yang bikin dark fantasy menarik, dunia yang kompleks, karakter yang morally grey, dan pertarungan yang genuinely seru untuk ditonton. Tapi yang bikin series ini naik level adalah Henry Cavill. Geralt di tangannya bukan sekadar monster hunter yang cool, ia adalah karakter yang punya kedalaman yang terasa nyata bahkan di balik armor dan pedangnya. Setiap scene yang ia bawain terasa grounded, dan itu yang bikin dunia The Witcher terasa believable meski penuh hal-hal yang fantastis.',
        ],
    ];
}

    public static function getMusik()
    {
        return [
           [
            'judul'        => 'Carrie & Lowell',
            'artis'        => 'Sufjan Stevens',
            'tahun'        => 2015,
            'genre'        => ['Folk', 'Indie Folk', 'Chamber Pop'],
            'mood'         => ['Melancholic', 'Intimate', 'Reflective'],
            'spotify_id'   => '0n7HLjx45Y2LD4WyHGDMf3',
            'artwork'      => asset('images/sufjanstevens.gif'),
            'lirik_fav'    => '"Did you get enough love, my little loon, why do you cry?"',
            'ulasan'       => 'Carrie & Lowell bukan album yang gampang didengarkan. Sufjan Stevens membuat sesuatu yang sangat personal di sini, sebuah reckoning dengan kehilangan, dengan masa kecil yang complicated, dengan pertanyaan yang nggak punya jawaban mudah. Setiap track terasa seperti halaman dari jurnal yang harusnya nggak pernah dibaca orang lain, tapi entah bagaimana justru karena itu terasa universal. Instrumentasinya sparse, suaranya tipis, dan itu bukan kelemahan. Itu pilihannya. Karena ada kesedihan yang nggak butuh orkestra untuk terasa besar. Carrie & Lowell adalah album yang aku dengarkan dengan headphone, volume pelan, and doing nothing.',
        ],
          [
            'judul'        => '30',
            'artis'        => 'Adele',
            'tahun'        => 2021,
            'genre'        => ['Pop', 'Soul', 'R&B'],
            'mood'         => ['Emotional', 'Reflective', 'Heartbreak'],
            'spotify_id'   => '21jF5jlMtzo94wbxmJ18aa',
            'artwork'      => asset('images/adele.gif'),
            'lirik_fav'    => '"\'Cause I want you so bad, but you can\'t fight fire with fire."',
            'ulasan'       => '30 adalah album yang Adele buat untuk dirinya sendiri, dan itu terasa di setiap tracknya. Ia nggak mencoba menyenangkan siapapun di sini. Ia hanya jujur, kadang terlalu jujur, tentang kehilangan, penyesalan, dan proses panjang yang namanya moving on. Yang bikin album ini berbeda dari breakup album lainnya adalah ia nggak marah. Ia hanya lelah, dan itu terasa jauh lebih manusiawi. I Drink Wine, Hold On, My Little Love, semuanya punya bobot yang berbeda tapi datang dari tempat yang sama. 30 adalah album yang paling pas didengarkan ketika kamu lagi berdamai dengan sesuatu yang belum selesai.',
        ],
           [
            'judul'        => 'The Beatles (White Album)',
            'artis'        => 'The Beatles',
            'tahun'        => 1968,
            'genre'        => ['Rock', 'Art Rock', 'Experimental'],
            'mood'         => ['Eclectic', 'Timeless', 'Nostalgic'],
            'spotify_id'   => '1klALx0u4AavZNEvC4LrTL',
            'artwork'      => asset('images/thebeatles.gif'),
            'lirik_fav'    => '"All your life, you were only waiting for this moment to arise."',
            'ulasan'       => 'White Album adalah album yang nggak bisa dijelasin dalam satu kata. The Beatles datang ke sini dengan empat kepribadian yang makin berbeda, dan alih-alih menyatukannya, mereka membiarkan semuanya ada sekaligus. Hasilnya adalah album yang paling nggak konsisten yang pernah mereka buat, dan justru itu yang membuatnya menarik. Satu momen terasa seperti folk yang tenang, momen berikutnya noise yang chaotic, dan entah bagaimana semuanya terasa seperti satu kesatuan. Blackbird sendiri adalah salah satu lagu yang susah aku jelasin kenapa selalu berhasil. Dua menit tiga puluh detik, gitar akustik, dan satu kalimat yang terasa seperti izin untuk akhirnya melangkah.',
        ],
        ];
    }

    public static function getBuku()
    {
        return [
            [
                'judul'        => 'To Kill a Mockingbird',
                'penulis'      => 'Harper Lee',
                'tahun_baca'   => 2018,
                'genre'        => ['Fiction', 'Classic', 'Historical Fiction'],
                'rekomendasi'  => 'must-read',
                'cover'        => asset('images/tokillamockingbird.jpg'),
                'kutipan'      => '"I wanted you to see what real courage is, instead of getting the idea that courage is a man with a gun in his hand."',
                'ulasan'       => 'To Kill a Mockingbird adalah buku yang kelihatannya tentang sebuah persidangan di kota kecil Amerika Selatan tahun 1930-an. Tapi Harper Lee menyimpan sesuatu yang jauh lebih besar di balik itu semua. Ia bercerita tentang keadilan, tentang keberanian, dan tentang apa yang terjadi ketika seseorang memilih untuk tetap berdiri di sisi yang benar bahkan ketika semua orang di sekitarnya memilih sebaliknya. Yang bikin buku ini berbekas bukan dramatisnya, tapi kejujurannya. Lee nggak mencoba bikin pembacanya marah atau sedih, ia hanya meletakkan segalanya di depanmu dengan sangat tenang, dan membiarkan kamu yang merasakannya sendiri. Dan kutipan Atticus soal keberanian itu, sampai sekarang masih jadi salah satu hal paling jujur yang pernah aku baca tentang apa artinya benar-benar berani.',
            ],
            [
            'judul'        => 'A Study in Scarlet',
            'penulis'      => 'Arthur Conan Doyle',
            'tahun_baca'   => 2015,
            'genre'        => ['Mystery', 'Detective Fiction', 'Classic'],
            'rekomendasi'  => 'good',
            'cover'        => asset('images//astudyinscarlet.jpg'),
            'kutipan'      => '"When you have eliminated the impossible, whatever remains, however improbable, must be the truth."',
            'ulasan'       => 'A Study in Scarlet adalah buku pertama yang benar-benar bikin aku jatuh cinta sama membaca. Bukan karena plotnya yang paling kompleks, atau karena karakternya paling dalam, tapi karena Arthur Conan Doyle menulis dengan cara yang terasa sangat hidup dan sangat cerdas sekaligus. Sherlock Holmes muncul di halaman pertama dan langsung terasa seperti seseorang yang nyata, seseorang yang cara berpikirnya terlalu menarik untuk tidak diikuti. Dan dari situ aku sadar bahwa membaca bisa jadi sesuatu yang genuinely menyenangkan, bukan kewajiban. A Study in Scarlet adalah alasan kenapa aku membaca.',
        ],
            [
            'judul'        => 'Anne of Green Gables',
            'penulis'      => 'L.M. Montgomery',
            'tahun_baca'   => 2023,
            'genre'        => ['Classic', 'Coming-of-Age', 'Fiction'],
            'rekomendasi'  => 'must-read',
            'cover'        => asset('images//anneofgreengables.jpeg'),
            'kutipan'      => '"Isn\'t it splendid to think of all the things there are to find out about? It just makes me feel glad to be alive."',
            'ulasan'       => 'Anne of Green Gables adalah buku yang kelihatannya sederhana, seorang anak perempuan yatim yang datang ke rumah baru dan perlahan menemukan tempatnya di dunia. Tapi L.M. Montgomery menulis Anne sebagai karakter yang genuinely susah untuk tidak dicintai. Ia cerewet, dramatis, dan terlalu imajinatif untuk dunia yang terlalu praktis di sekitarnya. Dan justru itu yang bikin setiap halamannya terasa hidup. Buku ini bukan tentang petualangan besar atau keputusan yang mengubah dunia. Ia tentang bagaimana seseorang yang penuh dengan rasa ingin tahu terhadap hidup bisa mengubah semua orang di sekitarnya tanpa pernah berniat melakukannya. Anne ninggalin sesuatu yang susah dijelasin, semacam pengingat bahwa hidup selalu punya sesuatu yang worth ditemukan, kalau kamu mau repot-repot mencarinya.',
        ],
        ];
    }

    public static function getOlahraga()
    {
        return [
            'deskripsi' => 'Working out was never just about the body for me — its about showing up, even when you dont feel like it.',
            'jenis' => [
                [
                    'nama'    => 'Weight Training',
                    'emoji'   => '🏋️',
                    'frekuensi' => '4x seminggu',
                    'catatan' => 'Push-pull-legs split. Fokus di compound lifts.',
                ],
                [
                    'nama'    => 'Running',
                    'emoji'   => '🏃',
                    'frekuensi' => '2x seminggu',
                    'catatan' => 'Morning run 5km. Playlist rnb wajib.',
                ],
                [
                    'nama'    => 'Stretching & Mobility',
                    'emoji'   => '🧘',
                    'frekuensi' => 'Tiap hari',
                    'catatan' => '15 menit sebelum tidur. Game changer untuk recovery.',
                ],
            ],
            'pr' => [ // Personal Records
                ['lift' => 'Bench Press', 'record' => '... kg'],
                ['lift' => 'Squat',       'record' => '... kg'],
                ['lift' => 'Deadlift',    'record' => '... kg'],
            ],
            'foto' => [
                'img/olahraga/gym1.jpg',  
                'img/olahraga/gym2.jpg',
                'img/olahraga/gym3.jpg',
            ],
            'quote' => 'Tubuh mencapai apa yang pikiran percaya.',
        ];
    }
    
}