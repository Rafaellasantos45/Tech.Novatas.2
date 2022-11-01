<?php

// Inicializa variáveis importantes:
$page_title = $page_content = $author_articles = '';

// Dados para conexão com MySQL/MariaDB e database:
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'technovatas';

/**
 * Define a tabela de caracteres para UTF-8:
 **/
header('Content-Type: text/html; charset=utf-8');

/**
 * Define fuso horário do aplicativo para horário de Brasília:
 **/
date_default_timezone_set('America/Sao_Paulo');

/**
 * Conexão com o MySQL/MariaDB e com o banco de dados:
 **/
$conn = new mysqli($hostname, $username, $password, $database);

// Seta transações com MySQL/MariaDB para UTF-8:
$conn->query('SET NAMES utf8');
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');

// Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil":
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

/**
 * Facilita o DEBUG dos códigos:
 **/
function debug($var, $exit = true, $dump = false)
{
    echo '<pre>';
    if ($dump) var_dump($var);
    else print_r($var);
    echo '</pre>';
    if ($exit) exit();
}

/**
 * Converte uma data para outro formato:
 * Exemplos:
 *      dt_convert('2022-10-31');
 *      dt_convert('2022-10-31', 'd/m/Y');
 *      dt_convert('31-10-2022', 'Y-m-d');
 *      dt_convert('31/10/2022 12:34:59', 'Y-m-d H:i');
 * Formato padrão, se omitido ◄───────────┐
 *                                        ▼
 **/
function dt_convert($date, $format = 'Y-m-d H:i:s')
{
    $date = str_replace('/', '-', $date);
    $d = date_create($date);
    return date_format($d, $format);
}