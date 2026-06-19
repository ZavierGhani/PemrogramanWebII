<?php
$nilai  = "";
$hasil  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilai = (int) $_POST["nilai"];

    if ($nilai == 0) {
        $hasil = "Nol";
    } elseif ($nilai >= 1 && $nilai <= 9) {
        $hasil = "Satuan";
    } elseif ($nilai >= 10 && $nilai <= 19) {
        $hasil = "Belasan";
    } elseif ($nilai >= 20 && $nilai <= 99) {
        $hasil = "Puluhan";
    } elseif ($nilai >= 100 && $nilai <= 999) {
        $hasil = "Ratusan";
    } else {
        $hasil = "Anda Menginput Melebihi Limit Bilangan";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK204</title>
</head>
<body>
    <form method="POST">
        Nilai : <input type="text" name="nilai" value="<?= $nilai ?>">
        <br><br>
        <button type="submit">Konversi</button>
    </form>

    <?php if ($hasil !== "") : ?>
    <h2>Hasil: <?= $hasil ?></h2>
    <?php endif; ?>
</body>
</html>