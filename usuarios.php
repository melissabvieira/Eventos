<?php
require 'classes/bd.php';  

$adm = [
    'usuario' => 'adm',
    'senha' => '123',
    'nome' => 'Administrador',
    'tipo' => 'adm'
];

$cliente = [
    'usuario' => 'cliente',
    'senha' => '123',
    'nome' => 'Cliente',
    'tipo' => 'cliente'
];

try {
    $result = $collectionUsuarios->insertMany([$adm, $cliente]);

    echo "Usuários criados com sucesso! IDs: <br>";
    foreach ($result->getInsertedIds() as $id) {
        echo $id . "<br>";
    }
} catch (Exception $e) {
    die("Erro ao criar usuários: " . $e->getMessage());
}
