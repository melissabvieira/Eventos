<?php
session_start();

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($usuario === 'adm' && $senha === '123') {
    $_SESSION['usuario'] = ['nome' => 'adm', 'tipo' => 'adm'];
    header('Location: home.php');
    exit();
} elseif ($usuario === 'cliente' && $senha === '123') {
    $_SESSION['usuario'] = ['nome' => 'cliente', 'tipo' => 'cliente'];
    header('Location: home.php');
    exit();
} else {
    header('Location: login.php?erro=1');
    exit();
}
?>
