<?php
$mahasiswa = [
    [
        "no"   => 1,
        "nama" => "Ridho",
        "matkul" => [
            ["nama" => "Pemrograman I",                  "sks" => 2],
            ["nama" => "Praktikum Pemrograman I",        "sks" => 1],
            ["nama" => "Pengantar Lingkungan Lahan Basah","sks" => 2],
            ["nama" => "Arsitektur Komputer",            "sks" => 3],
        ],
    ],
    [
        "no"   => 2,
        "nama" => "Ratna",
        "matkul" => [
            ["nama" => "Basis Data I",           "sks" => 2],
            ["nama" => "Praktikum Basis Data I", "sks" => 1],
            ["nama" => "Kalkulus",               "sks" => 3],
        ],
    ],
    [
        "no"   => 3,
        "nama" => "Tono",
        "matkul" => [
            ["nama" => "Rekayasa Perangkat Lunak",       "sks" => 3],
            ["nama" => "Analisis dan Perancangan Sistem", "sks" => 3],
            ["nama" => "Komputasi Awan",                 "sks" => 3],
            ["nama" => "Kecerdasan Bisnis",              "sks" => 3],
        ],
    ],
];

// Hitung total SKS dan keterangan
foreach ($mahasiswa as &$mhs) {
    $total = 0;
    foreach ($mhs["matkul"] as $mk) {
        $total += $mk["sks"];
    }
    $mhs["total_sks"]    = $total;
    $mhs["keterangan"] = $total < 7 ? "Revisi KRS" : "Tidak Revisi";
}
unset($mhs);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK403</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #534caf;
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Mata Kuliah Diambil</th>
            <th>SKS</th>
            <th>Total SKS</th>
            <th>Keterangan</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <?php foreach ($mhs["matkul"] as $index => $mk) : ?>
            <tr>
                <?php if ($index == 0) : ?>
                    <td rowspan="<?= count($mhs["matkul"]) ?>"><?= $mhs["no"] ?></td>
                    <td rowspan="<?= count($mhs["matkul"]) ?>"><?= $mhs["nama"] ?></td>
                <?php endif; ?>
                <td><?= $mk["nama"] ?></td>
                <td><?= $mk["sks"] ?></td>
                <?php if ($index == 0) : ?>
                    <td rowspan="<?= count($mhs["matkul"]) ?>"><?= $mhs["total_sks"] ?></td>
                   <td rowspan="<?= count($mhs["matkul"]) ?>" 
                        style="background-color: <?= $mhs["keterangan"] == "Revisi KRS" ? '#f44336' : '#4CAF50' ?>; color: white;">
                        <?= $mhs["keterangan"] ?>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>