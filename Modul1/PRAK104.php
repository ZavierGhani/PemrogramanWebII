<?php
$smartphones = [
    "Samsung Galaxy S22",
    "Samsung Galaxy S22+",
    "Samsung Galaxy A03",
    "Samsung Galaxy Xcover 5"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK104</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 3px solid black;
            padding: 4px 8px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Daftar Smartphone Samsung</th>
        </tr>
        <?php foreach ($smartphones as $item) : ?>
        <tr>
            <td><?= $item ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>