<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Funções</h1>

<?php 

// Cria a função
function soma($a, $b) {
    $result = $a + $b;
    return $result;
}

// Invocar a função
echo soma(3, 4);
?>
<br>

<?php echo soma(20, 50); ?>

</body>
</html>