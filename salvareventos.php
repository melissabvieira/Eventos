<?php
require 'classes/bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento = [
        'tema' => $_POST['tema'],
        'descricao_evento' => $_POST['descricao_evento'],
        'data_evento' => $_POST['data_evento'],
        'promotor' => $_POST['promotor'],
        'localizacao' => $_POST['localizacao'],
        'tags' => $_POST['tags'],
        'vagas_totais' => (int) $_POST['vagas_totais']
    ];

    $collection->insertOne($evento);
    header('Location: meuseventos.php?ok=1');
    exit;
}


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
