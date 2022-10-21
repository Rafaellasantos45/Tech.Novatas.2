<?php

// Define a tabela de caracteres para UTF-8:
header('Content-Type: text/html; charset=utf-8');

// Define fuso horário do aplicativo para horário de Brasília:
date_default_timezone_set('America/Sao_Paulo');

// Dados para conexão com MySQL e database:
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'technovatas';

// Conexão com o MySQL e com o banco de dados:
$conn = new mysqli($hostname, $username, $password, $database);

// TESTE DE CRUD
// CREATE → INSERT na tabela comments:

// Cria a query (SQL)  que insere um novo comentário:
$sql = "INSERT INTO comments (cauthor, article, comment) VALUES ('1', '1', 'Ainda não estou entendendo.');";

// Envia o SQL para o servidor MySQL:
$conn->query($sql);

// READ → SELECT na tabela articles:
$sql = "SELECT * FROM articles";

// Executa a consulta:
$res = $conn->query($sql);

// Recebe e formata cada artigo:
while ($art = $res->fetch_assoc()) {
    print_r($art);
}

// UPDATE -> UPDATE na tabela users:
$sql = "UPDATE users SET type = 'admin' WHERE uid = '3';";

// Executa a query:
$conn->query($sql);

// DELETE → DELETE na comments (NÃO FAÇA ISSO!!!):
$sql = "DELETE FROM comments WHERE cid = '4';";

// Executa a query:
$conn->query($sql);

// DELETE Educado → UPDATE na tabela comments:
$sql = "UPDATE comments SET cstatus = 'deleted' WHERE cid = '5';";

// Executa a query:
$conn->query($sql);

echo '<hr>';

// Exibir todos os comentários exceto os apagados:
$sql = "SELECT * FROM comments WHERE cstatus != 'deleted'";
$res = $conn->query($sql);
while($comentario = $res->fetch_assoc()) {
    print_r($comentario);
}