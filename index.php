<?php

// Importa configurações e funções:
require('includes/config.php');

// Obtém o endereço da página a ser acessada:
$route = mb_strtolower(htmlentities(trim($_SERVER['QUERY_STRING'])));

// Se não selecionou uma página, carrega a página inicial:
if ($route == '') $route = 'home';

// Caminho das páginas:
$path = $_SERVER['DOCUMENT_ROOT'];

// Dados da página que está sendo acessada:
$page = array(
    'php' => "pages/{$route}/index.php",
    'css' => "pages/{$route}/index.css",
    'js' => "pages/{$route}/index.js"
);

// Se a página não existe, exibe a página de erro 404:
if (!file_exists($page['php'])) :
    $page = array(
        'php' => "pages/404/index.php",
        'css' => "pages/404/index.css",
        'js' => "pages/404/index.js"
    );
endif;

// Carrega o PHP/HTML da página correta:
require($page['php']);

// Carrega o CSS da página correta caso exista:
if (file_exists($page['css']))
    $page_css = "<link rel=\"stylesheet\" href=\"/{$page['css']}\">";

// Carrega o JavaScript da página correta caso exista:
if (file_exists($page['js']))
    $page_js = "<script src=\"/{$page['js']}\"></script>";

// Processa o título da página:


// Monta links para as redes sociais no rodapé:
$social_nav = "<nav><h4>Redes sociais:</h4>";

for ($i = 0; $i < count($social); $i++) :

    $social_nav .= <<<HTML

<a href="{$social[$i]['link']}" target="_blank">
    <i class="fa-brands {$social[$i]['icon']} fa-fw"></i>
    <span>{$social[$i]['name']}</span>
</a>

HTML;

endfor;

$social_nav .= '</nav>';

?>
<!DOCTYPE html>

<!-- Referências: https://www.w3schools.com/html/ -->

<!-- Início do documento HTML -->
<html lang="pt-br">

<!-- Cabeçalho com metadados do documento -->

<head>

    <!-- Carrega a tabela de caracteres universal -->
    <meta charset="UTF-8">

    <!-- Deixa a página responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Carrega a folha de estilos do aplicativo -->
    <link rel="stylesheet" href="/style.css">

    <?php
    // Carrega CSS de uma página específica:
    echo $page_css;
    ?>

    <!-- Ícone de favoritos -->
    <link rel="shortcut icon" href="<?php echo $c['favicon'] ?>">

    <!-- Título do documento -->
    <title><?php echo $c['sitename'] ?></title>

</head>

<body>

    <!-- Âncora de retorno -->
    <a id="top"></a>

    <!-- Wrap da página -->
    <div id="wrap">

        <!-- Cabeçalho -->
        <header>

            <!-- Logotipo usando Font Awesome -->
            <a href="/" title="Página inicial">
                <img src="<?php echo $c['sitelogo'] ?>" alt="Logotipo de <?php echo $c['sitename'] ?>">
            </a>

            <!-- Nome / slogan do site -->
            <h1>
                <?php echo $c['sitename'] ?>
                <span><?php echo $c['siteslogan'] ?></span>
            </h1>
        </header>

        <!-- Menu principal -->
        <nav>

            <a href="/" title="Página inicial">
                <i class="fa-fw fa-solid fa-house-chimney"></i>
                <span>Início</span>
            </a>
            <a href="/?contacts">
                <i class="fa-fw fa-solid fa-comment-dots"></i>
                <span>Contatos</span>
            </a>
            <a href="/?about">
                <i class="fa-fw fa-solid fa-circle-info"></i>
                <span>Sobre</span>
            </a>
            <a href="/?profile">
                <i class="fa-fw fa-solid fa-user"></i>
                <span>Login</span>
            </a>

        </nav>

        <main id="content"><?php echo $content ?></main>

        <!-- Rodapé -->
        <footer>

            <div id="ftop">

                <!-- Link para a página inicial -->
                <a href="/" title="Página inicial">
                    <i class="fa-fw fa-solid fa-house-chimney"></i>
                </a>

                <!-- Licença do aplicativo -->
                <div>&copy; 2022 <?php echo $c['sitename'] ?></div>

                <!-- Link para o topo desta página -->
                <a href="#top">
                    <i class="fa-fw fa-solid fa-circle-up"></i>
                </a>

            </div>

            <div id="fbottom">

                <?php
                // Exibe a lista de redes sociais já formatada para o rodapé.
                echo $social_nav;
                ?>

                <nav>

                    <h4>Links rápidos:</h4>
                    <a href="/?contacts">
                        <i class="fa-fw fa-solid fa-comment-dots"></i>
                        <span>Contatos</span>
                    </a>
                    <a href="/?about">
                        <i class="fa-fw fa-solid fa-circle-info"></i>
                        <span>Sobre</span>
                    </a>
                    <a href="/?policies">
                        <i class="fa-solid fa-user-lock fa-fw"></i>
                        <span>Privacidade</span>
                    </a>

                </nav>

            </div>

        </footer>

        <!-- Rack que aplica margem inferior a <footer> -->
        <span>&nbsp;</span>

    </div>

    <!-- Carrega a boblioteca JavaScript "jQuery" à partir de CDNJS.  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Carrega o JavaScript do aplicativo -->
    <script src="/script.js"></script>

    <?php
    // Carrega JavaScript de uma página específica:
    echo $page_js;
    ?>

</body>

</html>