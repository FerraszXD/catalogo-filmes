<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}
include 'conexao.php';
$sql = "SELECT * FROM filmes ORDER BY ID_filme DESC";
$conn = conexao(); // chama a função pra pegar o objeto de conexão
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Gerenciar Filmes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Gerenciar Filmes</h1></header>

<div style="margin:20px; display:flex; gap:10px; justify-content:center;">
    <button class="voltar" onclick="window.location.href='inserir.php'">Adicionar Filme</button>
    <button class="voltar" onclick="window.location.href='catalogoADM.php'">Ver Catálogo</button>
    <button class="voltar" onclick="window.location.href='logout.php'">Sair</button>
</div>

<div style="overflow:auto; padding: 0 20px 40px;">
<table style="width:95%; margin: 0 auto; border-collapse: collapse;">
    <thead>
        <tr style="background:#ff9900; color:#0f0f0f;">
            <th>ID</th>
            <th>Título</th>
            <th>Duração (min)</th>
            <th>Preço</th>
            <th>Gênero</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr style="border-bottom:1px solid #333;">
            <td><?= $row['ID_filme'] ?></td>
            <td><?= htmlspecialchars($row['NOME_filme']) ?></td>
            <td><?= htmlspecialchars($row['DURACAO_filme']) ?></td>
            <td>R$ <?= number_format($row['PRECO_filme'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($row['TEMA_filme']) ?></td>
            <td><img src="<?= htmlspecialchars($row['IMAGEM_filme']) ?>" width="100" alt="capa"></td>
            <td>
                <button onclick="window.location.href='editar.php?id=<?= $row['ID_filme'] ?>'">Editar</button>
                <button onclick="if(confirm('Excluir este filme?')) window.location.href='excluir.php?id=<?= $row['ID_filme'] ?>'">Excluir</button>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>
</body>
</html>
