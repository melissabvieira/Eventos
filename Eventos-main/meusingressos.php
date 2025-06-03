<?php
require 'classes/bd.php';

$ingressos = $db->ingressos->find(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Ingressos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e9e9e9;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .ingresso {
            background: #fff;
            padding: 15px;
            margin: 15px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .ingresso h2 {
            margin-top: 0;
            color: #4d56dd;
        }
        .ingresso p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Meus Ingressos</h1>

    <?php foreach ($ingressos as $ingresso): ?>
        <div class="ingresso">
            <h2><?= htmlspecialchars($ingresso['evento_nome'] ?? 'Sem nome') ?></h2>
            <p><strong>Data:</strong> <?= htmlspecialchars($ingresso['data_evento'] ?? '-') ?></p>
            <p><strong>Local:</strong> <?= htmlspecialchars($ingresso['local'] ?? '-') ?></p>
            <p><strong>Ingresso:</strong> <?= htmlspecialchars($ingresso['tipo_ingresso'] ?? '-') ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
