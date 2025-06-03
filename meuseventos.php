<?php
require 'classes/bd.php';

// $eventos = $collection->find();
$eventos = ['tema' => 'teste', 'descricao_evento' => 'teste de descrição', '_id' => '1'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Todos os Eventos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        h1 { text-align: center; }
        .evento {
            background: #fff; padding: 15px; margin-bottom: 10px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        .botoes {
            margin-top: 10px;
        }
        .botoes a, .botoes form {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Todos os Eventos</h1>

    <?php foreach ($eventos as $evento): ?>
        <div class="evento">
            <h2><?= htmlspecialchars($evento['tema']) ?? 'Sem título' ?></h2>
            <p><?= htmlspecialchars($evento['descricao_evento']) ?? 'Sem descrição' ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars($evento['data_evento']) ?? 'Sem data' ?></p>

            <div class="botoes">
                <a href="editarevento.php?id=<?= $evento['_id'] ?>">Editar</a>
                <form action="excluirevento.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                    <input type="hidden" name="id" value="<?= $evento['_id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
