<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['id'])) {
    try {
        $id = new MongoDB\BSON\ObjectId($_POST['id']);
        $collectionEventos->deleteOne(['_id' => $id]);
    } catch (Exception $e) {
        echo "Erro ao excluir evento: " . $e->getMessage();
        exit();
    }
}

header("Location: meuseventos.php");
exit();
