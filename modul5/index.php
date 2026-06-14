<?php require "Model.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .card {
            background: white;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .menu a {
            display: block;
            padding: 10px 30px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
        }

        .menu a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Perpustakaan</h1>
        <div class="menu">
            <a href="Member.php">Member</a>
            <a href="Buku.php">Buku</a>
            <a href="Peminjaman.php">Peminjaman</a>
        </div>
    </div>
</body>
</html>