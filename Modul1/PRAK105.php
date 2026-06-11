<?php
$smartphones = [
    "s22"      => "Samsung Galaxy S22",
    "s22plus"  => "Samsung Galaxy S22+",
    "a03"      => "Samsung Galaxy A03",
    "xcover5"  => "Samsung Galaxy Xcover 5"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK105</title>
    <style>
        table {
            border-collapse: collapse;
            width: 300px;
        }
        .header {
            background-color: #ff0000;
            color: black;
            font-weight: bold;
            font-size: 20px;
            padding: 8px;
        }
        td {
            border: 3px solid black;
            padding: 4px 8px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="header">Daftar Smartphone Samsung</td>
        </tr>
        <?php foreach ($smartphones as $key => $value) : ?>
        <tr>
            <td><?= $value ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>