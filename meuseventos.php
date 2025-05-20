<?php
session_start();
require 'bd.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$eventos = $collection->find(['usuario_id' => $usuario_id]);
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
            <h2><?= htmlspecialchars($evento['titulo']) ?></h2>
            <p><?= htmlspecialchars($evento['descricao']) ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars($evento['data']) ?></p>

            <div class="botoes">
                <a href="editarevento.php?id=<?= $evento['_id'] ?>">✏️ Editar</a>
                <form action="excluirevento.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                    <input type="hidden" name="id" value="<?= $evento['_id'] ?>">
                    <button type="submit">🗑️ Excluir</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
