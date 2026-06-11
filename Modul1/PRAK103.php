<?php
$celcius = 37.841;

$fahrenheit = ($celcius * 9/5) + 32;
$reamur     = $celcius * 4/5;
$kelvin     = $celcius + 273.15;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK103</title>
</head>
<body>
    <p>Celcius = <?= $celcius ?></p>
    <p>Fahrenheit (F) = <?= number_format($fahrenheit, 4, ',', '') ?></p>
    <p>Reamur (R)     = <?= number_format($reamur, 4, ',', '') ?></p>
    <p>Kelvin (K)     = <?= number_format($kelvin, 4, ',', '') ?></p>
</body>
</html>