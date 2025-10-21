<?php
session_start();
session_destroy();
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>

<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: catalogo.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Login</h1>
    </header>

    <div class="catalogo" style="flex-direction: column; align-items: center;">
        <form action="verifica_login.php" method="POST" style="background-color: #1b1b1b; padding: 30px; border-radius: 10px; width: 300px;">
            <label for="usuario">Usuário</label><br>
            <input type="text" id="usuario" name="usuario" required style="width: 90%; margin: 10px 0; padding: 10px;"><br>

            <label for="senha">Senha</label><br>
            <input type="password" id="senha" name="senha" required style="width: 90%; margin: 10px 0; padding: 10px;"><br>

            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>
