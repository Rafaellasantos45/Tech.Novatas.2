<?php

/**
 * readall.php
 * Aplicativo que obtém todos os usuários válidos no sistema, formata e exibe 
 * no documento.
 */

/**
 * Importa as configurações e funções do aplicativo:
 * Referências: https://www.w3schools.com/php/php_includes.asp
 **/
require('includes/config.php');

/**
 * Declara / inicializa variável do aplicativo:
 * Neste caso, estamos criando um "menu principal" na variável $output que é 
 * usada no final do código, para exibir os resultados no navegador.
 **/
$output = '
<a href="/readall.php">Listar</a> 
|
<a href="/create.php">Cadastrar</a>
<hr>
';

// Monta a query que obtém TODOS os usuários válidos:
$sql = <<<SQL

SELECT uid, name, email, 
    -- Converte a data do MySQL para o formato descrito e envia por "udatebr".
    DATE_FORMAT(udate, '%d/%m/%Y às %H:%i:%s') AS udatebr
FROM users
-- Não obtém usuários apagados.
WHERE ustatus != 'deleted';

SQL;
 
// Executa a query:
$res = $conn->query($sql);

/**
 * Verifica se existem usuários:
 **/
if ($res->num_rows == 0) :
    // Se não exitem, exibe mensagem de erro:
    $output .= 'Oooops! Nenhum usuário cadastrado...';
else :

    // Se existem, inicia uma tabela com a lista de usuários:
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

    /**
     * Loop que obtém cada usuário da lista do banco de dados e monta as linhas
     * da tabela com os dados deste.
     **/
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
            <a href="delete.php?{$user['uid']}" onclick="return confirm(`Tem certeza que deseja apagar este usuário?\n\nNão tem como desfazer isso!`);">Apagar</a>
        </td>
    </tr>

HTML;        

    endwhile;

    $output .= '</table>';

endif;

// Envia saída para o navegador:
echo $output;
