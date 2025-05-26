<?php
session_start();
require 'bd.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Evento não encontrado.";
    exit();
}

$id = new MongoDB\BSON\ObjectId($_GET['id']);
$evento = $collection->findOne(['_id' => $id]);

if (!$evento) {
    echo "Evento não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
</head>
<body>
    <h1>Editar Evento</h1>
    <form action="atualizarevento.php" method="POST">
        <input type="hidden" name="id" value="<?= $evento['_id'] ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($evento['titulo']) ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required><?= htmlspecialchars($evento['descricao']) ?></textarea><br><br>

        <label>Data:</label><br>
        <input type="date" name="data" value="<?= $evento['data'] ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
