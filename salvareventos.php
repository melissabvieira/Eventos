<?php
require 'vendor/autoload.php'; 

use MongoDB\Client;

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$client = new Client("mongodb://localhost:27017");
$db = $client->selectDatabase('eventos'); 
$collection = $db->selectCollection('eventos');

$tema = $_POST['tema'] ?? '';
$descricao_evento = $_POST['descricao_evento'] ?? '';
$data_evento = $_POST['data_evento'] ?? '';
$promotor = $_POST['promotor'] ?? '';
$localizacao = $_POST['localizacao'] ?? '';
$vagas_totais = (int)($_POST['vagas_totais'] ?? 0);

if (isset($_FILES['imagem_evento']) && $_FILES['imagem_evento']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $nomeArquivo = uniqid() . '_' . basename($_FILES['imagem_evento']['name']);
    $uploadFile = $uploadDir . $nomeArquivo;
    
    if (!move_uploaded_file($_FILES['imagem_evento']['tmp_name'], $uploadFile)) {
        echo "Erro ao salvar imagem.";
        exit();
    }
    $imagem = $nomeArquivo;
} else {
    echo "Erro no upload da imagem.";
    exit();
}

try {
    $dateTime = new DateTime($data_evento);
    $dataMongo = new MongoDB\BSON\UTCDateTime($dateTime->getTimestamp() * 1000);
} catch (Exception $e) {
    echo "Data inválida.";
    exit();
}

$evento = [
    'tema' => $tema,
    'descricao_evento' => $descricao_evento,
    'data_evento' => $dataMongo,
    'promotor' => $promotor,
    'localizacao' => $localizacao,
    'vagas_totais' => $vagas_totais,
    'imagem' => $imagem,
];

$result = $collection->insertOne($evento);

if ($result->getInsertedCount() === 1) {
    header('Location: criareventos.php?ok=1');
    exit();
} else {
    echo "Erro ao salvar o evento no banco.";
}
?>
