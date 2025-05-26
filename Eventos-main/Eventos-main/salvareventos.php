<?php
require 'vendor/autoload.php'; 

use MongoDB\Client;


$mongo = new Client("mongodb://localhost:27017"); // alterar para o url da carol
$db = $mongo->eventos; 
$colecao = $db->eventos; 

$tema = $_POST['tema'];
$descricao = $_POST['descricao_evento'];
$dataEvento = $_POST['data_evento'];
$inscritos = !empty($_POST['inscritos']) ? array_map('trim', explode(',', $_POST['inscritos'])) : [];
$promotor = $_POST['promotor'];
$localizacao = $_POST['localizacao'];
$tags = !empty($_POST['tags']) ? array_map('trim', explode(',', $_POST['tags'])) : [];
$vagasTotais = (int) $_POST['vagas_totais'];
$vagasDisponiveis = $vagasTotais; 


$evento = [
    'tema' => $tema,
    'descricao_evento' => $descricao,
    'data_evento' => $dataEvento,
    'inscritos' => $inscritos,
    'promotor' => [ 'nome' => $promotor ],
    'localizacao' => [ 'endereco' => $localizacao ],
    'tags' => $tags,
    'vagas_totais' => $vagasTotais,
    'vagas_disponiveis' => $vagasDisponiveis
];

$insercao = $colecao->insertOne($evento);

header("Location: criar-evento.php?ok=1");
exit;
?>
