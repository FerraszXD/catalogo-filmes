<?php 

function conexao() {
// Conexão com o banco de dados
$host = "localhost";    // host
$user = "root";         // Usuário
$pass = "";             // Senha d
$dbname = "filmes";     // Nome do banco de dados 

// Cria a conexão usando a extensão mysqli
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se conectou
if ($conn->connect_error) {
    // Se houver erro de conexão, encerra o script e mostra a mensagem
    die("Erro na conexão: " . $conn->connect_error);
}

return $conn;
}
?>