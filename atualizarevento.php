<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    try {
        $id = new MongoDB\BSON\ObjectId($_POST['id']);

        $tema = $_POST['tema'] ?? '';
        $descricao_evento = $_POST['descricao_evento'] ?? '';
        $data_evento = $_POST['data_evento'] ?? '';
        $promotor = $_POST['promotor'] ?? '';
        $localizacao = $_POST['localizacao'] ?? '';
        $vagas_totais = isset($_POST['vagas_totais']) ? (int)$_POST['vagas_totais'] : 0;
        $data_evento_mongo = new MongoDB\BSON\UTCDateTime(strtotime($data_evento) * 1000);

        $collectionEventos->updateOne(
            ['_id' => $id],
            ['$set' => [
                'tema' => $tema,
                'descricao_evento' => $descricao_evento,
                'data_evento' => $data_evento_mongo,
                'promotor' => $promotor,
                'localizacao' => $localizacao,
                'vagas_totais' => $vagas_totais
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
