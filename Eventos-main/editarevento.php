<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $tema = $_POST['tema'];
    $descricao_evento = $_POST['descricao_evento'];
    $data_evento = $_POST['data_evento'];
    $promotor = $_POST['promotor'];
    $localizacao = $_POST['localizacao'];
    $tags = $_POST['tags'];
    $vagas_totais = (int) $_POST['vagas_totais'];

    $collection->updateOne(
        ['_id' => $id],
        ['$set' => [
            'tema' => $tema,
            'descricao_evento' => $descricao_evento,
            'data_evento' => $data_evento,
            'promotor' => $promotor,
            'localizacao' => $localizacao,
            'tags' => $tags,
            'vagas_totais' => $vagas_totais
        ]]
    );

    header("Location: meuseventos.php?editado=1");
    exit();
}
