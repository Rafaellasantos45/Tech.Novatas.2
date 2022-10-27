<?php

/**
 * read.php
 * Aplicativo que obtém todos os dados de um usuário específico, formata e 
 * exibe no documento.
 **/

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
$output = '<a href="/readall.php">Listar</a> | <a href="/create.php">Cadastrar</a><hr>';

/**
 * Obtém o Id do usuário da URL:
 * Referêcias: 
 *  • https://www.w3schools.com/php/func_var_intval.asp
 *  • https://www.w3schools.com/php/php_superglobals.asp
 *  • https://www.w3schools.com/php/php_superglobals_server.asp
 **/
$id = intval($_SERVER['QUERY_STRING']);

// Se não forneceu um Id ou este não é um número...
if ($id == 0) :

    // ... exibe mensagem de erro e encerra o programa:
    $output .= "<p>Oooops! Acesso inválido...";

// Se forneceu um Id válido...
else :

    /**
     * Monta a query de consulta:
     * Referências:
     *  • https://www.w3schools.com/mysql/default.asp → 
     *  • https://www.w3schools.com/php/php_mysql_intro.asp → 
     **/
    $sql = <<<SQL

-- Obtém todos os campos com dados do usuário.
SELECT *,
    -- Obtém a data de cadastro, formata e envia como 'udatebr'.
    DATE_FORMAT(udate, '%d/%m/%Y às %H:%i') AS udatebr,
    -- Obtém a data de aniversário, formata e envia como 'birthbr'.
    DATE_FORMAT(birth, '%d/%m/%Y') AS birthbr,
    -- Obtém a data do último login, formata e envia como 'last_loginbr'.
    DATE_FORMAT(last_login, '%d/%m/%Y às %H:%i') AS last_loginbr
FROM users
-- Filtra o usuário pelo ID...
WHERE uid = '{$id}'
    -- ... E, somente se o usuário não está apagado.
    AND ustatus != 'deleted';

SQL;

    /**
     * Executa a query e guarda os dados obtidos na variável '$res':
     * Referências:
     *  • https://www.w3schools.com/php/php_mysql_select.asp
     **/
    $res = $conn->query($sql);

    // Se não retornou um (e apenas um) usuário, exibe mensagem de erro:
    if ($res->num_rows != 1) :

        // Cria mensagem de erro:
        $output .= "<p>Oooops! Acesso inválido...";

    else :

        // Extrai os dados do usuário e guarda em $user:
        $user = $res->fetch_assoc();

        /**
         * Traduz o "type" para português e armazena em "$tipo":
         * Referências:
         *  • https://www.w3schools.com/php/php_switch.asp
         **/
        switch ($user['type']):

            case 'admin': // Traduz isso...
                $tipo = 'administrador'; // Para isso...
                break;

            case 'author': // Traduz isso...
                $tipo = 'autor'; // Para isso...
                break;

            case 'moderator':
                $tipo = 'moderador';
                break;

            case 'user':
                $tipo = 'usuário genérico';
                break;

        endswitch;

        /**
         * Tradus o status para português e armazena em '$status':
         * Referências:
         *  • https://www.w3schools.com/php/func_string_str_replace.asp
         **/
        $status = $user['ustatus'];
        $from = array('online', 'offline', 'deleted', 'banned');
        $to = array('disponível', 'indisponível', 'apagado', 'banido');
        $status = str_replace($from, $to, $status);

        // Se o usuário nunca logou, ou seja, $user['last_login'] é vazio...
        if ($user['last_login'] == '') :

            // Exibe mensagem:
            $last_login = 'Nunca logou';

        // Se usuário já logou:
        else :

            // Exibe a data do último login, formatada:
            $last_login = $user['last_loginbr'];

        endif;

        // Se achou o usuário, exibe os dados dele em HTML, usando 'Heredoc':
        $output .= <<<HTML

<img src="{$user['photo']}" alt="{$user['name']}">
<h3>{$user['name']}</h3>
<ul>
    <li>Cadastrado em {$user['udatebr']}</li>
    <li>Email: {$user['email']}</li>
    <li>Nascimento: {$user['birthbr']}</li>
    <li>Tipo: {$tipo}</li>
    <li>Último login: {$last_login}</li>
    <li>Status atual: {$status}</li>
    <li>Sobre:<br>{$user['bio']}</li>
</ul>

<a href="update.php?{$user['uid']}">Editar</a> | <a href="delete.php?{$user['uid']}">Apagar</a>

HTML;

    endif;

endif;

/**
 * Exibe as mensagens de saída e encerra o programa:
 * Referências:
 *  • https://www.w3schools.com/php/php_echo_print.asp
 **/
echo $output;
