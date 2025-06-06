<?php
session_start();
require 'classes/bd.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];

   $collection->updateOne(
    ['_id' => $id],
    ['$set' => [
        'titulo' => $titulo,
        'descricao' => $descricao,
        'data' => $data
    ]]
);


    header("Location: meuseventos.php");
    exit();
}
