<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
</head>
<body>
<h1 align="center">CATÁLOGO DE FILMES</h1>

<div align="center">
   
    <button onclick="window.location.href='catalogo_terror.php'">TERROR</button>
    <button onclick="window.location.href='catalogo_comedia.php'">COMÉDIA</button>
    <button onclick="window.location.href='catalogo_acao.php'">AÇÃO</button>
    <button onclick="window.location.href='catalogo_suspense.php'">SUSPENSE</button>
    <br><br>
    <button class="voltar" onclick="window.location.href='logout.php'">SAIR</button>

    <!--botoes para varias paginas-->
    
</div>

<hr>
<!-- linha que separa o cabeçalho -->
<?php 

// Conexão com o banco de dados
require_once 'conexao.php';
$conn = conexao();

// Puxa todos os filmes 
$sql = "SELECT * FROM filmes";
//quais colunas eu quero puxar 

// Executa a query no banco
$result = $conn->query($sql);

// Verifica se a consulta retornou alguma coisa
if ($result->num_rows > 0) {
    // Se houver resultados, começa a montar a tabela HTML para exibir os filmes
    echo "<table align='center' border='1' cellpadding='10'>";

    // Cabeçalho da tabela
    echo "<tr>
    <th>Cartaz</th>
    <th>Nome</th>
    <th>Duração</th>
    <th>Preço</th>
    <th>Gênero</th>
    <th>Assista</th>
    </tr>";

    // Loop que percorre todas as linhas retornadas
    while ($row = $result->fetch_assoc()) {
        // $row contem as linhas das variaveis
        echo "<tr>";
            // Coluna da imagem 
            echo "<td><img src='" . $row['IMAGEM_filme'] . "' width='100'></td>";

            // Coluna do nome do filme
            echo "<td>" . $row['NOME_filme'] . "</td>";

            // Coluna da duração
            echo "<td>" . $row['DURACAO_filme'] . " min</td>";

            // Coluna do preço
            echo "<td>R$ " . number_format($row['PRECO_filme'], 2, ',', '.') . "</td>";

            echo "<td>" . $row['TEMA_filme'] . "</td>";

            // Coluna do borao
            echo "<td><button onclick=\"window.location.href='filme.php'\"> ASSISTIR </button></td>";
        echo "</tr>";
    }

    // Fecha a tabela HTML
    echo "</table>";
} else {
    // Se não houver resultados, mostra uma mensagem amigável
    echo "<p align='center'>Nenhum filme encontrado 😢</p>";
}

// Fecha a conexão com o banco 
$conn->close();
?>



</body>
</html>
