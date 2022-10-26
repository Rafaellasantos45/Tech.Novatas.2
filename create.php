<?php

/**
 * Importa as configurações e funções do aplicativo:
 * Referências: https://www.w3schools.com/php/php_includes.asp
 **/
require('includes/config.php');

// Declara / inicializa variáveis do aplicativo:
$output = '
<a href="/create.php">Cadastrar</a> |
<a href="/readall.php">Listar</a>
<hr>
';

/**
 * Detecta se o formulário foi enviado:
 * Referências: https://www.w3schools.com/php/func_var_isset.asp
 **/
if (isset($_POST['send'])) :

    // Processar o formulário:
    // debug($_POST, false);

    // Converte data BR para system date:
    $birth = datesys($_POST['birth']);

    // Query que insere dados do form no banco de dados:
    $sql = <<<SQL

INSERT INTO users (
    name,
    email,
    password,
    photo,
    birth,
    bio
) VALUES (
    '{$_POST['name']}',
    '{$_POST['email']}',
    SHA1('{$_POST['password']}'),
    '{$_POST['photo']}',
    '{$birth}',
    '{$_POST['bio']}'
);

SQL;

    // Executa a query:
    $conn->query($sql);

    // Gera o feedback:
    $output .= "Oba! Usuário cadastrado com sucesso...";

else :

    // Cria o formulário de cadastro → HTML:
    $output .= <<<HTML

<h2>Cadastra usuário (Create)</h2>

<form method="post" action="{$_SERVER['PHP_SELF']}">
 
    <input type="hidden" name="send" value="ok">
    Nome: <input type="text" name="name" value="Roberto da Silva"><br>
    E-mail: <input type="text" name="email" value="roberto@silva.com"><br>
    Senha: <input type="text" name="password" value="senha123"><br>
    Foto: <input type="text" name="photo" value="https://randomuser.me/api/portraits/men/24.jpg"><br>
    Nacimento: <input type="text" name="birth" value="16/12/2000"><br>
    Biografia: <input type="text" name="bio" value="Arrumador de computador."><br>
    <button type="submit">Salvar</button>

</form>

HTML;

endif;

// Envia saída para o navegador:
echo $output;
