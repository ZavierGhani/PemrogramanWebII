<?php
$jari_jari = 4.2;
$phi       = M_PI; // konstanta PI bawaan PHP (3.14159...)

$volume = (4/3) * $phi * pow($jari_jari, 3);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK102</title>
</head>
<body>
    <p>Jari-jari = <?= $jari_jari ?></p>
    <p>Volume Bola = <?= number_format($volume, 3, '.', '') ?> m³</p>
</body>
</html>