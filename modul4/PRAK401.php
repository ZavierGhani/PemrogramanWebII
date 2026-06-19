<?php
$panjang = "";
$lebar   = "";
$nilai   = "";
$matriks = [];
$error   = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $panjang = (int) $_POST["panjang"];
    $lebar   = (int) $_POST["lebar"];
    $nilai   = trim($_POST["nilai"]);

    $arr = explode(" ", $nilai);

    if (count($arr) != $panjang * $lebar) {
        $error = "Panjang nilai tidak sesuai dengan ukuran matriks";
    } else {
        $index = 0;
        for ($i = 0; $i < $panjang; $i++) {
            for ($j = 0; $j < $lebar; $j++) {
                $matriks[$i][$j] = $arr[$index];
                $index++;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK401</title>
</head>
<body>
    <form method="POST">
        Panjang : <input type="text" name="panjang" value="<?= $panjang ?>"><br><br>
        Lebar : <input type="text" name="lebar" value="<?= $lebar ?>"><br><br>
        Nilai : <input type="text" name="nilai" value="<?= $nilai ?>" size="40"><br><br>
        <button type="submit">Cetak</button>
    </form>

    <?php if ($error != "") : ?>
        <p><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($matriks)) : ?>
        <table border="1" cellpadding="8">
            <?php foreach ($matriks as $baris) : ?>
            <tr>
                <?php foreach ($baris as $sel) : ?>
                <td><?= $sel ?></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>