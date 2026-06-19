<?php
$tinggi = 0;
$gambar = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tinggi = (int) $_POST["tinggi"];
    $gambar = $_POST["gambar"];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK302</title>
</head>
<body>
    <form method="POST">
        Tinggi : <input type="text" name="tinggi" 
        value="<?= $tinggi ?>"><br><br>
        Alamat Gambar : <input type="text" 
        name="gambar" value="<?= $gambar ?>" 
        size="40"><br><br>
        <button type="submit">Cetak</button>
    </form>

    <?php if ($tinggi > 0 && $gambar != "") : ?>
<div style="display: inline-block; line-height: 0;">
    <?php
    $baris = 1;
    while ($baris <= $tinggi) :
        $jumlah_gambar = $tinggi - $baris + 1;
    ?>
    <div style="text-align: right; width: <?= $tinggi 
    * 38 ?>px; line-height: normal;">
        <?php
        $j = 1;
        while ($j <= $jumlah_gambar) : ?>
            <img src="<?= $gambar ?>" width="30" height="30" 
            style="display: inline-block; margin: 
            1px;">
        <?php
            $j++;
        endwhile;
        ?>
    </div>
    <?php
        $baris++;
    endwhile;
    ?>
</div>
<?php endif; ?>
</body>
</html>