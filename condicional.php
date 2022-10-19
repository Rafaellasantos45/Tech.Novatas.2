<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Estruturas condicionais</h1>

    <?php

    $teste = 'Ana';

    if ($teste == 'Maria') {
        // Se a exp acima for true
        echo 'Ola           ' . $teste;
        echo 'Bem-vinda!';
    } elseif ($teste == 'Joca') {
        // Se a primeira exp for false a acima for true
        echo 'Ola ' . $teste;
        echo 'Como vai!';
    } elseif ($teste == 'Ana') {
        echo 'Ola ' . $teste;
        echo 'Tudo ok?';
    } else {
        // Se todas as exp forem falsas
        echo 'Usuário incorreto!';
        echo 'Tente novamente!';
    }
    ?>
    <hr>
    <?php

    $teste = 'Ana';

    if ($teste == 'Maria') :
        // Se a exp acima for true
        echo 'Ola           ' . $teste;
        echo 'Bem-vinda!';
    elseif ($teste == 'Joca') :
        // Se a primeira exp for false a acima for true
        echo 'Ola ' . $teste;
        echo 'Como vai!';
    elseif ($teste == 'Ana') :
        echo 'Ola ' . $teste;
        echo 'Tudo ok?';
    else :
        // Se todas as exp forem falsas
        echo 'Usuário incorreto!';
        echo 'Tente novamente!';
    endif;

    ?>
    <hr>
    <?php

    $teste = 'Anna';

    switch ($teste) {

        case 'Maria':
            echo 'Ola ' . $teste;
            echo 'Bem-vinda!';
            break;
        case 'Joca':
            echo 'Ola ' . $teste;
            echo 'Como vai!';
            break;
        case 'Ana':
            echo 'Ola ' . $teste;
            echo 'Tudo ok?';
            break;
        default:
            echo 'Usuário incorreto!';
            echo 'Tente novamente!';
            break;
    }

    ?>
    <hr>
    <?php

    $teste = 'Anna';

    switch ($teste):

        case 'Maria':
            echo 'Ola ' . $teste;
            echo 'Bem-vinda!';
            break;
        case 'Joca':
            echo 'Ola ' . $teste;
            echo 'Como vai!';
            break;
        case 'Ana':
            echo 'Ola ' . $teste;
            echo 'Tudo ok?';
            break;
        default:
            echo 'Usuário incorreto!';
            echo 'Tente novamente!';
            break;

    endswitch;

    ?>

</body>

</html>