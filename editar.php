<?php
include 'conexao.php';
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM filmes WHERE ID_filme = ?";
$conn = conexao(); // chama a função pra pegar o objeto de conexão
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$filme = $res->fetch_assoc();
if (!$filme) {
    echo "<script>alert('Filme não encontrado'); window.location.href='gerencia.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Editar Filme</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Editar Filme</h1></header>

<div style="display:flex; justify-content:center; padding:30px;">
<form action="atualizar.php" method="POST" style="background:#1b1b1b; padding:20px; border-radius:8px; width:360px;">
    <input type="hidden" name="id" value="<?= $filme['ID_filme'] ?>">
    <input type="text" name="nome" value="<?= htmlspecialchars($filme['NOME_filme']) ?>" required style="width:100%; padding:8px; margin:8px 0;">
    <input type="number" name="duracao" value="<?= htmlspecialchars($filme['DURACAO_filme']) ?>" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="preco" value="<?= number_format($filme['PRECO_filme'], 2, '.', '') ?>" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="tema" value="<?= htmlspecialchars($filme['TEMA_filme']) ?>" style="width:100%; padding:8px; margin:8px 0;">
    <input type="text" name="imagem" value="<?= htmlspecialchars($filme['IMAGEM_filme']) ?>" style="width:100%; padding:8px; margin:8px 0;">
    <div style="display:flex; gap:8px; justify-content:center; margin-top:10px;">
        <button type="submit">Atualizar</button>
        <button type="button" onclick="window.location.href='gerencia.php'">Cancelar</button>
    </div>
</form>
</div>
</body>
</html>
