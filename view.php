<?php

// Importa a configuração do site:
require('includes/config.php');

/***************************************************
 * Todos os códigos PHP desta página INICIAM aqui! *
 ***************************************************/

// Obtém o ID do artigo diretamente da URL:
$id = intval($_SERVER['QUERY_STRING']);

// Se o ID é ZERO...
if ($id == 0)
    // Mostra a página 404:
    header('Location: /404.php');

// SQL que otém o artigo completo:
$sql = <<<SQL

-- Seleciona todos os campos do artigo:
SELECT *,

    -- Formata data para pt-br:
    DATE_FORMAT(adate, '%d de %M de %Y às %H:%i') AS adatebr,

    -- Formata a data de nascimento do autor para pt-br:
    DATE_FORMAT(birth, '%d/%m/%Y') AS birthbr

FROM articles

-- Obtém também os dados do autor do artigo:
INNER JOIN users ON uid = author

-- Somente co artigo com o ID especificado:
WHERE aid = '{$id}'

    -- E com status 'online':
    AND astatus = 'online'

    -- E não agendados para o futuro:
    AND adate <= NOW();

SQL;

// Executar o SQL e armazenar os resultados em '$res':
$res = $conn->query($sql);

// Se não achou o artigo...
if ($res->num_rows != 1)
    // Mostra a página 404:
    header('Location: /404.php');

// Extrai os dados do artigo:
$art = $res->fetch_assoc();

// SQL que obtém todos os OUTROS artigos do autor:
$sql = <<<SQL

SELECT aid, title
FROM articles
WHERE author = '{$art['uid']}'
    AND astatus = 'online'
    AND adate <= NOW()

    -- Não mostra o artigo atual:
    AND aid != '{$id}'

ORDER BY RAND()

LIMIT 6;    

SQL;

debug($sql);

// Extrai a lista de artigos do autor:
$res = $conn->query($sql);

// Se tem artigos:
if ($res->num_rows > 0):

///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

endif;

// Monta avisualização do artigo
$page_content .= <<<HTML

<h2>{$art['title']}</h2>

<small>Por {$art['name']}.</small><br>
<small>Em {$art['adatebr']}.</small>

{$art['content']}

<p>══════════════════</p>

<div>

    <img src="{$art['photo']}" alt="{$art['name']}">
    <h3>{$art['name']}</h3>
    <ul>
        <li>E-mail: {$art['email']}</li>
        <li>Nascimento: {$art['birthbr']}</li>
    </ul>
    <p>{$art['bio']}</p>
    {$author_articles}

</div>

HTML;

// Define o título do documento:
$page_title = $art['title'];

/****************************************************
 * Todos os códigos PHP desta página TERMINAM aqui! *
 ****************************************************/

// Cabeçalho da página HTML:
require('header.php');

/******************************************************
 * Todo código HTML visível desta página COMEÇA aqui! *
 ******************************************************/
?>

<?php echo $page_content ?>

<?php
/*******************************************************
 * Todo código HTML visível desta página TERMINA aqui! *
 *******************************************************/

// Rodapé da página HTML:
require('footer.php');
?>