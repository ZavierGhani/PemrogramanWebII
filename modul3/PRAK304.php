<?php
$jumlah = 0;
$aksi   = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = (int) $_POST["jumlah"];
    $aksi   = $_POST["aksi"] ?? "";

    if ($aksi == "Tambah") {
        $jumlah++;
    } elseif ($aksi == "Kurang" && $jumlah > 0) {
        $jumlah--;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK304</title>
</head>
<body>
    <?php if ($aksi == "") : ?>
        <form method="POST">
            Jumlah bintang <input type="text"
             name="jumlah"><br><br>
            <button type="submit" name="aksi" 
            value="Submit">Submit</button>
        </form>
    <?php else : ?>
        <form method="POST">
            <input type="hidden" name="jumlah" 
            value="<?= $jumlah ?>">
            <p>Jumlah bintang <?= $jumlah ?></p>
            <?php
            $i = 1;
            while ($i <= $jumlah) : ?>
                <img src="bintang.png" width="80"
                 height="80">
            <?php
                $i++;
            endwhile;
            ?>
            <br><br>
            <button type="submit" name="aksi" 
            value="Tambah">Tambah</button>
            <button type="submit" name="aksi" 
            value="Kurang">Kurang</button>
        </form>
    <?php endif; ?>
</body>
</html>