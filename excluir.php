<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}
include 'conexao.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $sql = "DELETE FROM filmes WHERE ID_filme = ?";
    $conn = conexao(); // chama a função pra pegar o objeto de conexão
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header('Location: gerencia.php');
exit();
