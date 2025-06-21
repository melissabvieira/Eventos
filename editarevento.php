<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Evento não especificado.");
}

try {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $evento = $collectionEventos->findOne(['_id' => $id]);

    if (!$evento) {
        die("Evento não encontrado.");
    }
} catch (Exception $e) {
    die("Erro ao carregar evento: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <h1>TICKETMAIS</h1>
    <a href="meuseventos.php" class="btn btn-light">Voltar</a>
</header>

<div class="form-container">
    <h2>Editar Evento</h2>
    <form action="atualizarevento.php" method="POST">
        <input type="hidden" name="id" value="<?= (string)$evento['_id'] ?>">

        <div class="form-group">
            <label>Tema:</label>
            <input type="text" name="tema" class="form-control" value="<?= htmlspecialchars($evento['tema'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao_evento" class="form-control" required><?= htmlspecialchars($evento['descricao_evento'] ?? '') ?></textarea>
        </div>

        <?php
        $data_evento_formatada = '';

        if (isset($evento['data_evento'])) {
            if ($evento['data_evento'] instanceof MongoDB\BSON\UTCDateTime) {
                $data_evento_formatada = $evento['data_evento']->toDateTime()->format('Y-m-d\TH:i');
            }
        }
        ?>

        <div class="form-group">
            <label>Data do Evento:</label>
            <input type="datetime-local" name="data_evento" class="form-control" value="<?= $data_evento_formatada ?>" required>
        </div>

        <div class="form-group">
            <label>Promotor:</label>
            <input type="text" name="promotor" class="form-control" value="<?= htmlspecialchars($evento['promotor'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Localização:</label>
            <input type="text" name="localizacao" class="form-control" value="<?= htmlspecialchars($evento['localizacao'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Vagas Totais:</label>
            <input type="number" name="vagas_totais" class="form-control" value="<?= htmlspecialchars($evento['vagas_totais'] ?? 0) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
