<?php
$nilai  = "";
$dari   = "";
$ke     = "";
$hasil  = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilai = $_POST["nilai"];
    $dari  = $_POST["dari"];
    $ke    = $_POST["ke"];

    // Konversi semua ke Celcius dulu
    if ($dari == "celcius")     $celcius = $nilai;
    if ($dari == "fahrenheit")  $celcius = ($nilai - 32) * 5/9;
    if ($dari == "reamur")      $celcius = $nilai * 5/4;
    if ($dari == "kelvin")      $celcius = $nilai - 273.15;

    // Dari Celcius konversi ke tujuan
    if ($ke == "celcius")       $hasil = $celcius;
    if ($ke == "fahrenheit")    $hasil = ($celcius * 9/5) + 32;
    if ($ke == "reamur")        $hasil = $celcius * 4/5;
    if ($ke == "kelvin")        $hasil = $celcius + 273.15;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK203</title>
</head>
<body>
    <form method="POST">
        Nilai : <input type="text" name="nilai" value="<?= $nilai ?>"><br><br>

        Dari :<br>
        <input type="radio" name="dari" value="celcius"    <?= $dari == "celcius"    ? "checked" : "" ?>> Celcius<br>
        <input type="radio" name="dari" value="fahrenheit" <?= $dari == "fahrenheit" ? "checked" : "" ?>> Fahrenheit<br>
        <input type="radio" name="dari" value="reamur"     <?= $dari == "reamur"     ? "checked" : "" ?>> Rheamur<br>
        <input type="radio" name="dari" value="kelvin"     <?= $dari == "kelvin"     ? "checked" : "" ?>> Kelvin<br><br>

        Ke :<br>
        <input type="radio" name="ke" value="celcius"    <?= $ke == "celcius"    ? "checked" : "" ?>> Celcius<br>
        <input type="radio" name="ke" value="fahrenheit" <?= $ke == "fahrenheit" ? "checked" : "" ?>> Fahrenheit<br>
        <input type="radio" name="ke" value="reamur"     <?= $ke == "reamur"     ? "checked" : "" ?>> Rheamur<br>
        <input type="radio" name="ke" value="kelvin"     <?= $ke == "kelvin"     ? "checked" : "" ?>> Kelvin<br><br>

        <button type="submit">Konversi</button>
    </form>

    <?php if ($hasil !== null) : ?>
    <h2>Hasil Konversi: <?= number_format($hasil, 1, '.', '') ?> °<?= strtoupper(substr($ke, 0, 1)) ?></h2>
    <?php endif; ?>
</body>
</html>