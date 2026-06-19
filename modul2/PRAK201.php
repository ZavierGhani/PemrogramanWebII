<?php
$nama1 = $nama2 = $nama3 = "";
$hasil = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama1 = $_POST["nama1"];
    $nama2 = $_POST["nama2"];
    $nama3 = $_POST["nama3"];

    $arr = [$nama1, $nama2, $nama3];

    if (strcasecmp($arr[0], $arr[1]) > 0) { $tmp = $arr[0]; $arr[0] = $arr[1]; $arr[1] = $tmp; }
    if (strcasecmp($arr[1], $arr[2]) > 0) { $tmp = $arr[1]; $arr[1] = $arr[2]; $arr[2] = $tmp; }
    if (strcasecmp($arr[0], $arr[1]) > 0) { $tmp = $arr[0]; $arr[0] = $arr[1]; $arr[1] = $tmp; }

    $hasil = $arr;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK201</title>
</head>
<body>
    <form method="POST">
        Nama: 1 <input type="text" name="nama1" value="<?= $nama1 ?>"><br><br>
        Nama: 2 <input type="text" name="nama2" value="<?= $nama2 ?>"><br><br>
        Nama: 3 <input type="text" name="nama3" value="<?= $nama3 ?>"><br><br>
        <button type="submit">Urutkan</button>
    </form>

    <?php if (!empty($hasil)) : ?>
    <table border="1" cellpadding="15">
        <tr><th>Output</th></tr>
        <?php foreach ($hasil as $nama) : ?>
        <tr><td><?= $nama ?></td></tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>