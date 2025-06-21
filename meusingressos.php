<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['_id'];

try {
    $collectionIngressos = $db->selectCollection('ingressos');
    $ingressos = $collectionIngressos->find(['usuario_id' => $usuario_id])->toArray();

    $collectionEventos = $db->selectCollection('eventos');
} catch (Exception $e) {
    die('Erro ao carregar ingressos: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Meus Ingressos</title>
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
        .ingresso {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .ingresso h2 {
            color: #4d56dd;
            margin-top: 0;
        }
        .ingresso p {
            margin: 5px 0;
        }
        a.btn-light {
            color: #4d56dd;
            border: 1px solid #4d56dd;
        }
        a.btn-light:hover {
            background-color: #4d56dd;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <h1>TICKETMAIS</h1>
    <a href="home.php" class="btn btn-light">Voltar</a>
</header>

<?php if (!empty($ingressos)): ?>
    <?php foreach ($ingressos as $ingresso): ?>
        <?php
            $evento = $collectionEventos->findOne(['_id' => $ingresso['evento_id']]);
        ?>
        <div class="ingresso">
        <h2><?= isset($evento['tema']) ? htmlspecialchars($evento['tema']) : 'Sem título' ?></h2>
    
            <?php if (!empty($evento['imagem'])): ?>
        <img src="uploads/<?= htmlspecialchars($evento['imagem']) ?>" alt="Imagem do evento" style="max-width: 300px; display: block; margin-bottom: 10px;">
            <?php endif; ?>
            
            <p><strong>Data do Evento:</strong> 
                <?php 
                if (isset($evento['data_evento']) && $evento['data_evento'] instanceof MongoDB\BSON\UTCDateTime) {
                    echo htmlspecialchars($evento['data_evento']->toDateTime()->format('d/m/Y H:i'));
                } else {
                    echo 'Sem data';
                }
                ?>
            </p>

            <p><strong>Local:</strong> <?= isset($evento['localizacao']) ? htmlspecialchars($evento['localizacao']) : '-' ?></p>

            <p><strong>Ingresso comprado em:</strong> 
                <?php
                if (isset($ingresso['data_compra']) && $ingresso['data_compra'] instanceof MongoDB\BSON\UTCDateTime) {
                    echo htmlspecialchars($ingresso['data_compra']->toDateTime()->format('d/m/Y'));
                } else {
                    echo '-';
                }
                ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Você ainda não comprou nenhum ingresso.</p>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
