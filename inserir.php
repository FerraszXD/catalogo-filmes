<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}

include 'conexao.php'; // garante que $conn exista

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // pega e sanitiza os inputs
    $nome   = trim($_POST['nome']   ?? '');
    $duracao= (int)($_POST['duracao'] ?? 0);
    $preco  = str_replace(',', '.', ($_POST['preco'] ?? '0'));
    $preco  = (float)$preco;
    $imagem = trim($_POST['imagem'] ?? '');
    $tema   = trim($_POST['tema']   ?? '');

    // validações mínimas
    if ($nome === '') {
        echo "<script>alert('Preencha o título'); window.history.back();</script>";
        exit();
    }

    // prepara a query com tipos corretos: s (string), i (int), d (double), s, s
    $sql = "INSERT INTO filmes (NOME_filme, DURACAO_filme, PRECO_filme, IMAGEM_filme, TEMA_filme) VALUES (?, ?, ?, ?, ?)";
    $conn = conexao(); // chama a função pra pegar o objeto de conexão
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // falha no prepare -> reporta erro claro
        $err = $conn->error;
        echo "<script>alert('Erro no servidor (prepare): " . addslashes($err) . "'); window.location.href='gerencia.php';</script>";
        exit();
    }

    // AQUI: todas as variáveis já existem, então bind_param não gera "undefined variable"
    $stmt->bind_param("sidss", $nome, $duracao, $preco, $imagem, $tema);

    if ($stmt->execute()) {
        echo "<script>alert('Filme adicionado com sucesso'); window.location.href='gerencia.php';</script>";
        exit();
    } else {
        $err = $stmt->error;
        echo "<script>alert('Erro ao inserir: " . addslashes($err) . "'); window.location.href='gerencia.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Adicionar Filme</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Adicionar Filme</h1></header>

<div style="display:flex; justify-content:center; padding:30px;">
<form action="inserir.php" method="POST" style="background:#1b1b1b; padding:20px; border-radius:8px; width:360px;">
    <input type="text" name="nome" placeholder="Título" required style="width:100%; padding:8px; margin:8px 0;">
    <input type="number" name="duracao" placeholder="Duração (min)" min="0" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="preco" placeholder="Preço (ex: 12.50)" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="tema" placeholder="Gênero / Tema" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="imagem" placeholder="URL da imagem" style="width:100%; padding:8px; margin:8px 0;">
    <div style="display:flex; gap:8px; justify-content:center; margin-top:10px;">
        <button type="submit">Salvar</button>
        <button type="button" onclick="window.location.href='gerencia.php'">Cancelar</button>
    </div>
</form>
</div>
</body>
</html>
