<?php
session_start();

// Usuários e senhas 
$usuarios = [
    'admin' => ['senha' => '1234', 'tipo' => 'admin'],
    'rafa' => ['senha' => 'abcd', 'tipo' => 'user']
];

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if (isset($usuarios[$usuario]) && $usuarios[$usuario]['senha'] === $senha) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] = $usuarios[$usuario]['tipo'];

    if ($_SESSION['tipo'] === 'admin') {
        header('Location: gerencia.php');
    } else {
        header('Location: catalogo.php');
    }
    exit();
} else {
    echo "<script>alert('Usuário ou senha incorretos!'); window.location.href='index.php';</script>";
}
