<?php
require "Model.php";

if (isset($_GET["hapus"])) {
    $result = deleteMember($_GET["hapus"]);
    if ($result === "punya_peminjaman") {
        header("Location: Member.php?error=punya_peminjaman");
    } else {
        header("Location: Member.php?sukses=hapus");
    }
    exit;
}

$dataMember = getAllMember();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Member</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sidebar h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .content h1 {
            margin-bottom: 20px;
            font-size: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            font-size: 13px;
        }

        .notif {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: bold;
        }

        .notif-sukses {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .notif-error {
            background-color: #fde8e8;
            color: #c0392b;
            border: 1px solid #f5c6cb;
        }

        .btn-hapus { background-color: #e74c3c; }
        .btn-ubah  { background-color: #f39c12; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Data Member</h2>
        <a href="Index.php">Kembali</a>
        <a href="FormMember.php">Tambah Data Member</a>
    </div>

    <div class="content">
        <h1>Daftar Member Perpustakaan</h1>

        <?php if (isset($_GET["sukses"])) : ?>
        <div class="notif notif-sukses">
            <?php
            if ($_GET["sukses"] == "tambah") echo "✓ Data berhasil ditambahkan!";
            if ($_GET["sukses"] == "ubah")   echo "✓ Data berhasil diubah!";
            if ($_GET["sukses"] == "hapus")  echo "✓ Data berhasil dihapus!";
            ?>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET["error"])) : ?>
        <div class="notif notif-error">
            <?php if ($_GET["error"] == "punya_peminjaman") : ?>
                ✗ Data tidak bisa dihapus karena masih memiliki data peminjaman!
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID Member</th>
                <th>Nama Member</th>
                <th>Nomor Member</th>
                <th>Alamat</th>
                <th>Tgl Mendaftar</th>
                <th>Tgl Terakhir Bayar</th>
                <th>Opsi</th>
            </tr>
            <?php foreach ($dataMember as $member) : ?>
            <tr>
                <td><?= $member["id_member"] ?></td>
                <td><?= $member["nama_member"] ?></td>
                <td><?= $member["nomor_member"] ?></td>
                <td><?= $member["alamat"] ?></td>
                <td><?= $member["tgl_mendaftar"] ?></td>
                <td><?= $member["tgl_terkahir_bayar"] ?></td>
                <td>
                    <a href="Member.php?hapus=<?= $member["id_member"] ?>"
                       class="btn btn-hapus"
                       onclick="return confirm('Yakin hapus member ini?')">Hapus</a>
                    <a href="FormMember.php?id=<?= $member["id_member"] ?>"
                       class="btn btn-ubah">Ubah</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>