<?php
$input  = "";
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input  = $_POST["input"];
    $panjang = strlen($input);
    $string  = strtolower($input);

    $i = 0;
    while ($i < $panjang) {
        $huruf = $string[$i];
        $output .= strtoupper($huruf);

        $j = 1;
        while ($j < $panjang) {
            $output .= $huruf;
            $j++;
        }
        $i++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PRAK305</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="input" 
        value="<?= $input ?>">
        <button type="submit">submit</button>
    </form>

    <?php if ($output != "") : ?>
    <h3>Input:</h3>
    <p style="font-size: 18px"><?= $input ?></p>
    <h3>Output:</h3>
    <p style="font-size: 18px"><?= $output ?></p>
    <?php endif; ?>
</body>
</html>