<?php
session_start();
require 'bd.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$ingressos = $mongo->ingressos->find(['usuario_id' => $usuario_id]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Ingressos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e9e9e9; padding: 20px; }
        h1 { text-align: center; }
        .ingresso {
            background: #fff; padding: 15px; margin-bottom: 10px;
            border: 1px solid #ccc; border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Meus Ingressos</h1>

    <?php foreach ($ingressos as $ingresso): ?>
        <div class="ingresso">
            <h2><?= htmlspecialchars($ingresso['evento_nome']) ?></h2>
            <p><strong>Data:</strong> <?= htmlspecialchars($ingresso['data_evento']) ?></p>
            <p><strong>Local:</strong> <?= htmlspecialchars($ingresso['local']) ?></p>
            <p><strong>Ingresso:</strong> <?= htmlspecialchars($ingresso['tipo_ingresso']) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
