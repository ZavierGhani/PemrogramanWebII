<?php
$bawah = "";
$atas  = "";
$hasil = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bawah = (int) $_POST["bawah"];
    $atas  = (int) $_POST["atas"];

    $i = $bawah;
    do {
        $hasil[] = $i;
        $i++;
    } while ($i <= $atas);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK303</title>
</head>
<body>
    <form method="POST">
        Batas Bawah : <input type="text" name="bawah" value="<?= $bawah ?>"><br><br>
        Batas Atas : <input type="text" name="atas" value="<?= $atas ?>"><br><br>
        <button type="submit">Cetak</button>
    </form>

    <?php if (!empty($hasil)) : ?>
    <p style="font-size: 20px">
        <?php foreach ($hasil as $angka) : ?>
            <?php if (($angka + 7) % 5 == 0) : ?>
                <img src="bintang.png" width="25" height="25">
            <?php else : ?>
                <?= $angka ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </p>
    <?php endif; ?>
</body>
</html>