<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Laços de repetição</h1>

    <?php

    $num1 = 11;
    while ($num1 <= 10):
        $num2 = 0;
        while ($num2 <= 10) {
            $res = $num1 * $num2;
            echo "{$num1} x {$num2} = {$res}<br>";
            $num2++; // $num2 = $num2 + 1;
        }
        $num1++;
        if ($num1 == 5) $num1++;
        echo '<hr>';
    endwhile;
    ?>

    <hr>
    <hr>

    <?php
    for ($x = -10; $x <= 10; $x++) {
        echo "{$x}<br>";
    }
    ?>

<?php
    for ($x = -10; $x <= 10; $x++):
        echo "{$x}<br>";
    endfor;
    ?>

</body>

</html>