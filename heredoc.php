<?php
$title = "Minha Página";

// Heredoc
$conteudo = <<<conteudo

<p>Lorem ipsum</p>
<p>Lorem ipsum</p>
<p>Lorem ipsum</p>
<p>Lorem ipsum</p>

conteudo;

/**
 * Heredoc permite a inserção textos com quaisquer tipo de caracteres na string
 * e também suporta "interpolação".
 * Para saber mais: 
 *   https://www.dialhost.com.br/blog/heredoc-e-nowdoc-tratamento-de-strings-com-php/
 */

$minha_pagina = <<<pipoca
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
</head>
<body>

<h1>Minha Página</h1>
{$conteudo}
    
<script>console.log('Olá mundo!');</script>
</body>
</html>

pipoca;

echo $minha_pagina;

?>