<?php
require 'classes/bd.php';

if (isset($_GET['ok'])) {
    echo "<script>alert('Evento criado com sucesso!');</script>";
}

$totalEventos = $collection->countDocuments();

if ($totalEventos === 0) {
    $collection->insertOne([
        'tema' => 'Lollapalooza',
        'descricao_evento' => 'Festival de eventos',
        'data_evento' => '2025-04-04T20:00',
        'promotor' => 'Sistema de Teste', 
        'localizacao' => 'Local de Teste',
        'tags' => 'teste,exemplo',
        'vagas_totais' => 100
    ]);
}

$eventos = $collection->find();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Eventos</title>
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
    <h1>Meus Eventos</h1>

    <?php foreach ($eventos as $evento): ?>
        <div class="evento">
            <h2><?= isset($evento['tema']) ? htmlspecialchars($evento['tema']) : 'Sem título' ?></h2>
            <p><?= isset($evento['descricao_evento']) ? htmlspecialchars($evento['descricao_evento']) : 'Sem descrição' ?></p>
            <p><strong>Data:</strong> <?= isset($evento['data_evento']) ? htmlspecialchars($evento['data_evento']) : 'Sem data' ?></p>

            <div class="botoes">
                <a href="editarevento.php?id=<?= (string) $evento['_id'] ?>">Editar</a>
                <form action="excluirevento.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                    <input type="hidden" name="id" value="<?= (string) $evento['_id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
 
