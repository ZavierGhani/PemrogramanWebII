<?php
$nama  = "";
$nim   = "";
$jk    = "";
$errors = [];
$sukses = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $nim  = $_POST["nim"];
    $jk   = $_POST["jk"] ?? "";

    if (empty($nama)) $errors["nama"] = "nama tidak boleh kosong";
    if (empty($nim))  $errors["nim"]  = "nim tidak boleh kosong";
    if (empty($jk))   $errors["jk"]   = "jenis kelamin tidak boleh kosong";

    if (empty($errors)) {
        $sukses = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK202</title>
</head>
<body>
    <form method="POST">
        Nama: <input type="text" name="nama" value="<?= $nama ?>"> <span style="color:red">*</span> 
        <?php if (isset($errors["nama"])) : ?>
            <span style="color:red"> <?= $errors["nama"] ?></span>
        <?php endif; ?>
        <br><br>

        Nim: <input type="text" name="nim" value="<?= $nim ?>"> <span style="color:red">*</span>
        <?php if (isset($errors["nim"])) : ?>
            <span style="color:red"> <?= $errors["nim"] ?></span>
        <?php endif; ?>
        <br><br>

        Jenis Kelamin :<span style="color:red">*</span>
        <?php if (isset($errors["jk"])) : ?>
            <span style="color:red"><?= $errors["jk"] ?></span>
        <?php endif; ?>
        <br>
        <input type="radio" name="jk" value="Laki-laki" <?= $jk == "Laki-laki" ? "checked" : "" ?>> Laki-Laki<br>
        <input type="radio" name="jk" value="Perempuan" <?= $jk == "Perempuan" ? "checked" : "" ?>> Perempuan<br><br>

        <button type="submit">Submit</button>
    </form>

   <?php if ($sukses) : ?>
    <br>
    <h2>Output:</h2>
    <?= $nama ?> <br>
    <?= $nim ?><br>
    <?= $jk ?><br>
<?php endif; ?>
</body>
</html>