<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
if (!isset($usuario['tipo']) || $usuario['tipo'] !== 'adm') {
    die("Acesso negado. Apenas administradores podem acessar o dashboard.");
}

$eventosPorMes = $collectionEventos->aggregate([
    [
        '$group' => [
            '_id' => [
                'ano' => ['$year' => '$data_evento'],
                'mes' => ['$month' => '$data_evento']
            ],
            'total' => ['$sum' => 1]
        ]
    ],
    [
        '$sort' => ['_id.ano' => 1, '_id.mes' => 1]
    ]
])->toArray();

$eventosPorLocal = $collectionEventos->aggregate([
    [
        '$group' => [
            '_id' => '$localizacao',
            'total' => ['$sum' => 1]
        ]
    ],
    [
        '$sort' => ['total' => -1]
    ]
])->toArray();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TICKETMAIS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        header {
            background-color: #4d56dd;
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-weight: bold;
        }
        .dashboard-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .dashboard-section h2 {
            color: #4d56dd;
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        li:last-child {
            border-bottom: none;
        }
        .btn-voltar {
            background-color: white;
            color: #4d56dd;
            font-weight: bold;
            border-radius: 5px;
            padding: 8px 15px;
            text-decoration: none;
        }
        .btn-voltar:hover {
            background-color: #e8eaf6;
        }
    </style>
</head>
<body>

<header>
    <h1>Dashboard - TICKETMAIS</h1>
    <a href="home.php" class="btn-voltar">Voltar</a>
</header>

<div class="dashboard-section">
    <h2>Eventos por Mês</h2>
    <?php if (!empty($eventosPorMes)): ?>
        <ul>
            <?php foreach ($eventosPorMes as $item): ?>
                <li>
                    <strong><?= $item['_id']['ano'] . '-' . str_pad($item['_id']['mes'], 2, '0', STR_PAD_LEFT); ?>:</strong>
                    <?= $item['total']; ?> evento(s)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum evento cadastrado por mês.</p>
    <?php endif; ?>
</div>

<div class="dashboard-section">
    <h2>Eventos por Localização</h2>
    <?php if (!empty($eventosPorLocal)): ?>
        <ul>
            <?php foreach ($eventosPorLocal as $item): ?>
                <li>
                    <strong><?= htmlspecialchars($item['_id'] ?? 'Sem localização'); ?>:</strong>
                    <?= $item['total']; ?> evento(s)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum evento cadastrado por local.</p>
    <?php endif; ?>
</div>

</body>
</html>
