<?php
$jumlah = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = (int) $_POST["jumlah"];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK301</title>
</head>
<body>
    <form method="POST">
        Jumlah Peserta : <input type="text" name="jumlah" value="<?= $jumlah ?>">
        <br><br>
        <button type="submit">Cetak</button>
    </form>

    <?php
    $i = 1;
    while ($i <= $jumlah) : ?>
        <h2 style="color: <?= ($i % 2 == 0) ? 'green' : 'red' ?>">
            Peserta ke-<?= $i ?>
        </h2>
    <?php
        $i++;
    endwhile;
    ?>
</body>
</html>