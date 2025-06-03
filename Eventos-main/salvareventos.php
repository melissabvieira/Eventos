<?php
require 'vendor/autoload.php'; 

use MongoDB\Client;
use MongoDB\BSON\UTCDateTime;

$mongo = new Client("mongodb://localhost:27017"); // alterar para o URL da Carol
$db = $mongo->eventos; 
$colecao = $db->eventos;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método inválido");
}

$tema = $_POST['tema'];
$descricao = $_POST['descricao_evento'];
$dataEventoStr = $_POST['data_evento'];
$inscritos = !empty($_POST['inscritos']) ? array_map('trim', explode(',', $_POST['inscritos'])) : [];
$promotor = $_POST['promotor'];
$localizacao = $_POST['localizacao'];
$tags = !empty($_POST['tags']) ? array_map('trim', explode(',', $_POST['tags'])) : [];
$vagasTotais = (int) $_POST['vagas_totais'];
$vagasDisponiveis = $vagasTotais;

if (!$tema || !$descricao || !$dataEventoStr || !$promotor || !$localizacao || $vagasTotais <= 0) {
    die("Por favor, preencha todos os campos obrigatórios corretamente.");
}

try {
    $dataEvento = new DateTime($dataEventoStr);
    $dataEventoMongo = new UTCDateTime($dataEvento->getTimestamp() * 1000);
} catch (Exception $e) {
    die("Data inválida.");
}

$evento = [
    'tema' => $tema,
    'descricao_evento' => $descricao,
    'data_evento' => $dataEventoMongo,
    'inscritos' => $inscritos,
    'promotor' => [ 'nome' => $promotor ],
    'localizacao' => [ 'endereco' => $localizacao ],
    'tags' => $tags,
    'vagas_totais' => $vagasTotais,
    'vagas_disponiveis' => $vagasDisponiveis
];

$insercao = $colecao->insertOne($evento);

header("Location: criareventos.php?ok=1");
exit;
?>
