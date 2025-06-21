<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $id = new MongoDB\BSON\ObjectId($_POST['id']);
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $data = $_POST['data'];
        $data_mongo = new MongoDB\BSON\UTCDateTime(strtotime($data) * 1000);

        $collectionEventos->updateOne(
            ['_id' => $id],
            ['$set' => [
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data' => $data_mongo
            ]]
        );

        header("Location: meuseventos.php?editado=1");
        exit();

    } catch (Exception $e) {
        die("Erro ao atualizar o evento: " . $e->getMessage());
    }
} else {
    header("Location: meuseventos.php");
    exit();
}
?>
