<?php
require 'vendor/autoload.php';
use MongoDB\Client;

try {
    $mongoClient = new Client("mongodb://localhost:27017");
    $db = $mongoClient->selectDatabase('eventos');
    $collectionEventos = $db->selectCollection('eventos');
    $collectionUsuarios = $db->selectCollection('usuarios');

} catch (Exception $e) {
    die("Erro ao conectar no MongoDB: " . $e->getMessage());
}

function listarEventos() {
    global $collectionEventos;  
    try {
        return $collectionEventos->find()->toArray();
    } catch (Exception $e) {
        die("Erro ao listar eventos: " . $e->getMessage());
    }
}

?>
