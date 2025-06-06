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
    <meta charset="UTF-8" />
    <title>Meus Eventos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
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

<header>
    <h1>TICKETMAIS</h1>
    <a href="home.php" class="btn btn-light">Voltar</a>
</header>

<?php foreach ($eventos as $evento): ?>
    <div class="evento">
        <h2><?= isset($evento['tema']) ? htmlspecialchars($evento['tema']) : 'Sem título' ?></h2>
        <p><?= isset($evento['descricao_evento']) ? htmlspecialchars($evento['descricao_evento']) : 'Sem descrição' ?></p>
        <p><strong>Data:</strong> <?= isset($evento['data_evento']) ? htmlspecialchars($evento['data_evento']) : 'Sem data' ?></p>

        <div class="botoes">
            <a href="editarevento.php?id=<?= (string) $evento['_id'] ?>" class="btn btn-primary btn-sm">Editar</a>
            <form action="excluirevento.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                <input type="hidden" name="id" value="<?= (string) $evento['_id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
