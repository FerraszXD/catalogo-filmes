<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
</head>
<body>
<h1 align="center">CATÁLOGO DE FILMES</h1>

<div align="center">
   
    <button onclick="window.location.href='catalogo_terror.html'">TERROR</button>
    <button onclick="window.location.href='catalogo_comedia.html'">COMÉDIA</button>
    <button onclick="window.location.href='catalogo_acao.html'">AÇÃO</button>
    <button onclick="window.location.href='catalogo_suspense.html'">SUSPENSE</button>
    <br><br>
    <button onclick="window.location.href='index.php'">SAIR</button>

    <!--botoes para varias paginas-->
    
</div>

<hr>
<!-- linha que separa o cabeçalho -->
<?php 
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

// Puxa todos os filmes 
$sql = "SELECT ID_filme, NOME_filme, DURACAO_filme, PRECO_filme, IMAGEM_filme FROM filmes";
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
    <th>Comprar</th>
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

            // Coluna do borao
            echo "<td><button>Comprar ingresso</button></td>";
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
