<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $nome = $_POST['nome'] ?? '';
    $duracao = (int)($_POST['duracao'] ?? 0);
    $preco = str_replace(',', '.', ($_POST['preco'] ?? '0'));
    $imagem = $_POST['imagem'] ?? '';
    $tema = $_POST['tema'] ?? '';

    $sql = "UPDATE filmes SET NOME_filme=?, DURACAO_filme=?, PRECO_filme=?, IMAGEM_filme=?, TEMA_filme=? WHERE ID_filme=?";
    $conn = conexao(); // chama a função pra pegar o objeto de conexão
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $preco_str = (string)$preco;
    $stmt->bind_param("sisssi", $nome, $duracao, $preco_str, $imagem, $tema, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Atualizado com sucesso'); window.location.href='gerencia.php';</script>";
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
} else {
    header('Location: gerencia.php');
    exit();
}
