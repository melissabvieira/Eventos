<?php
session_start();
require 'classes/bd.php';  

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['evento_id'])) {
    try {
        $evento_id = new MongoDB\BSON\ObjectId($_POST['evento_id']);
        $collectionIngressos = $db->selectCollection('ingressos');

        
        $ingresso = [
            'usuario_id' => $usuario_id,
            'evento_id' => $evento_id,
            'data_compra' => new MongoDB\BSON\UTCDateTime()
        ];

        $collectionIngressos->insertOne($ingresso);

        header('Location: meusingressos.php');
        exit();
    } catch (Exception $e) {
        die("Erro ao comprar ingresso: " . $e->getMessage());
    }
} else {
    echo "Dados inválidos para a compra.";
}
?>
