<?php
require 'vendor/autoload.php';
use MongoDB\Client;

try {
    $mongoClient = new Client("mongodb://localhost:27017");
    $db = $mongoClient->selectDatabase('eventos');
    $collection = $db->selectCollection('eventos');
} catch (Exception $e) {
    die("Erro ao conectar no MongoDB: " . $e->getMessage());
}
?>
