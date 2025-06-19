<?php
session_start();
require 'classes/bd.php';


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);

    $collection->deleteOne(['_id' => $id]);
}

header("Location: meuseventos.php");
exit();
