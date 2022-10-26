<?php

// Importa as configurações do aplicativo:
require('includes/config.php');

// Declara / inicializa variáveis do aplicativo:
$output = '
<a href="/create.php">Cadastrar</a> |
<a href="/readall.php">Listar</a>
<hr>
';

// Monta a query que obtém TODOs os usuários:
$sql = <<<SQL

SELECT uid, name, email, 
    DATE_FORMAT(udate, '%d/%m/%Y às %H:%i:%s') AS udatebr
FROM users
WHERE ustatus != 'deleted';

SQL;

// Executa a query:
$res = $conn->query($sql);

// Verifica se existem usuários:
if ($res->num_rows == 0) :
    $output .= 'Oooops! Nenhum usuário cadastrado...';
else :

    // Inicia a tabela com a lista de usuários:
    $output .= '
    <h3>Lista de usuários</h3>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Data de cadastro</th>
        <th>Ações</th>
    </tr>
    ';

    // Loop que obtém cada usuário:
    while ($user = $res->fetch_assoc()) :

        $output .= <<<HTML

    <tr>
        <td>{$user['uid']}</td>
        <td>{$user['name']}</td>
        <td>{$user['email']}</td>
        <td>{$user['udatebr']}</td>
        <td>
            <a href="read.php?{$user['uid']}">Ver</a>
            <a href="update.php?{$user['uid']}">Editar</a>
            <a href="delete.php?{$user['uid']}">Apagar</a>
        </td>
    </tr>

HTML;        

    endwhile;

    $output .= '</table>';

endif;

// Envia saída para o navegador:
echo $output;
