<?php
require 'vendor/autoload.php';

use MongoDB\Client;

function listarEventos() {
    $client = new Client("mongodb://localhost:27017");
    $db = $client->selectDatabase('eventos');
    $collection = $db->selectCollection('eventos');

    $eventos = $collection->find()->toArray();
    return $eventos;
}
