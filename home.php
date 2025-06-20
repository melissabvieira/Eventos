<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
if (!is_array($usuario) || !isset($usuario['tipo'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

require 'classes/bd.php';

$eventosBanco = listarEventos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Compre Ingressos para Eventos | TICKETMAIS</title>

  <meta name="description" content="Compre ingressos para eventos incríveis no TICKETMAIS. Shows, esportes e mais." />
  <meta name="keywords" content="TICKETMAIS, eventos, ingressos, shows, esportes, cultura" />
  <meta name="author" content="TICKETMAIS" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 80px;
      padding-bottom: 60px;
      background-color: #f0f0f0;
    }
    header {
      background-color: #4d56dd;
      color: white;
      padding: 30px 40px;
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
    }
    .ticketmais {
      font-style: italic;
      font-size: 20px;
    }
    .acoes {
      display: flex;
      gap: 15px;
    }
    .acoes div {
      background-color: white;
      color: #4d56dd;
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    footer {
      background-color: #4d56dd;
      color: white;
      padding: 20px 40px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    .carousel, .carousel-item {
      width: 100vw;
      height: 100vh;
      margin: 0;
    }
    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 30px;
      padding: 0 20px;
    }
    .event-card {
      width: 300px;
      margin: 15px;
    }
  </style>
</head>
<body>

<header>
  <div class="ticketmais">TICKETMAIS</div>
  <div class="acoes">
    <?php if ($usuario['tipo'] === 'adm'): ?>
      <a href="dashboard.php"><div>Dashboard</div></a>
      <a href="meuseventos.php"><div>Meus eventos</div></a>
      <a href="criareventos.php"><div>Criar eventos</div></a>
      <a href="logout.php"><div>Sair</div></a>
    <?php elseif ($usuario['tipo'] === 'cliente'): ?>
      <a href="meusingressos.php"><div>Meus ingressos</div></a>
      <a href="logout.php"><div>Sair</div></a>
    <?php endif; ?>
  </div>
</header>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="classes/imagens/dualipa.jpeg" alt="Show Dua Lipa">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/linkinpark.jpeg" alt="Show Linkin Park">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/lagum.jpeg" alt="Show Lagum">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/NBA.jpeg" alt="NBA">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/roupanova.jpeg" alt="Show Roupa Nova">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/hellokitty.jpeg" alt="Hello Kitty">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="classes/imagens/napoleao.jpeg" alt="Experiência Napoleão">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>

<div class="card-container">
  <?php if (!empty($eventosBanco)): ?>
    <?php foreach ($eventosBanco as $evento): ?>
      <div class="card event-card">
        <?php if (!empty($evento['imagem'])): ?>
          <img class="card-img-top" src="uploads/<?php echo htmlspecialchars($evento['imagem']); ?>" alt="Imagem do evento">
        <?php else: ?>
          <img class="card-img-top" src="classes/imagens/placeholder.jpeg" alt="Sem imagem">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($evento['tema'] ?? 'Evento'); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($evento['descricao_evento'] ?? 'Descrição não disponível.'); ?></p>
          <form action="comprar.php" method="POST">
            <input type="hidden" name="evento_id" value="<?php echo htmlspecialchars((string)$evento['_id']); ?>">
            <button type="submit" class="btn btn-primary">Comprar Ingresso</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Nenhum evento disponível no momento.</p>
  <?php endif; ?>
</div>


<div class="card-container">
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/ney.jpeg" alt="Ney Matogrosso">
    <div class="card-body">
      <h5 class="card-title">NEY MATOGROSSO</h5>
      <p class="card-text">Garanta sua presença na turnê "Bloco na Rua"</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/sisters.jpeg" alt="The Sisters of Mercy">
    <div class="card-body">
      <h5 class="card-title">THE SISTERS OF MERCY</h5>
      <p class="card-text">Turnê na América Latina com 4 shows garantidos pelo Brasil</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/roxy.jpeg" alt="Roxy">
    <div class="card-body">
      <h5 class="card-title">ROXY DINNER SHOW</h5>
      <p class="card-text">Dirigido por Abel Gomes, o espetáculo promete uma viagem pelas tradições brasileiras, com gastronomia, música, dança, poesia e arte visual.</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/gustavo.jpeg" alt="Gustavo Mioto">
    <div class="card-body">
      <h5 class="card-title">GUSTAVO MIOTO</h5>
      <p class="card-text">O lançamento de uma turnê inédita, que promete proporcionar aos fãs uma experiência mais intimista</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/bb.jpeg" alt="Bad Bunny">
    <div class="card-body">
      <h5 class="card-title">BAD BUNNY</h5>
      <p class="card-text">Ele fará história como o primeiro artista latino a se apresentar em estádios no mundo todo, incluindo Europa, Austrália e América Latina</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/zoo.jpeg" alt="Zoologico de São Paulo">
    <div class="card-body">
      <h5 class="card-title">ZOOLOGICO DE SÃO PAULO</h5>
      <p class="card-text">Contando com mais de dois mil animais de diversas espécies, proporcionando aos visitantes a oportunidade de conhecer um pouco mais sobre a fauna do Brasil e do mundo</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
  <div class="card event-card">
    <img class="card-img-top" src="classes/imagens/jardim.jpeg" alt="Jardim">
    <div class="card-body">
      <h5 class="card-title">JARDIM BOTÂNICO</h5>
      <p class="card-text">Um espaço centenário e abriga coleções históricas de plantas vivas.</p>
      <a href="#" class="btn btn-primary">Comprar Ingresso</a>
    </div>
  </div>
</div>

<footer>
  <p>&copy; 2025 - TICKETMAIS</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
