<?php
require 'classes/bd.php';

$ingressos = $db->ingressos->find(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Meus Ingressos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        header {
            background-color: #4d56dd;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        header h1 {
            margin: 0;
            font-weight: bold;
            font-style: italic;
            font-size: 24px;
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

<header>
    <h1>TICKETMAIS</h1>
    <a href="home.php" class="btn btn-light">Voltar</a>
</header>

<?php foreach ($ingressos as $ingresso): ?>
    <div class="ingresso">
        <h2><?= htmlspecialchars($ingresso['evento_nome'] ?? 'Sem nome') ?></h2>
        <p><strong>Data:</strong> <?= htmlspecialchars($ingresso['data_evento'] ?? '-') ?></p>
        <p><strong>Local:</strong> <?= htmlspecialchars($ingresso['local'] ?? '-') ?></p>
        <p><strong>Ingresso:</strong> <?= htmlspecialchars($ingresso['tipo_ingresso'] ?? '-') ?></p>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
