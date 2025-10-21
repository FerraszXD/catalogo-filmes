<?php
session_start();
session_destroy();

// destrói qualquer resquício de sessão
$_SESSION = array();

// redireciona pro login
header('Location: index.php');
exit();
