<?php
session_start();
require 'classes/bd.php'; 

$usuarioInput = $_POST['usuario'] ?? '';
$senhaInput = $_POST['senha'] ?? '';

try {
    $collectionUsuarios = $db->selectCollection('usuarios');
    $usuarioEncontrado = $collectionUsuarios->findOne([
        'usuario' => $usuarioInput,
        'senha' => $senhaInput
    ]);

    if ($usuarioEncontrado) {
        $_SESSION['usuario'] = [
            '_id' => $usuarioEncontrado['_id'],
            'nome' => $usuarioEncontrado['nome'] ?? $usuarioInput,
            'tipo' => $usuarioEncontrado['tipo'] ?? 'cliente'
        ];

        header('Location: home.php');
        exit();
    } else {
        header('Location: login.php?erro=1');
        exit();
    }
} catch (Exception $e) {
    die('Erro ao verificar login: ' . $e->getMessage());
}
?>
