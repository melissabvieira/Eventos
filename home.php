<?php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    .carousel {
      max-width: 2000px;
      margin: 5px auto;
    }

    .carousel img {
      height: 450px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <header>
    <div class="ticketmais">TICKETMAIS</div>
    <div class="acoes">
      <a href="meuseventos.php"><div>Meus eventos</div></a>
      <a href="meusingressos.php"><div>Meus ingressos</div></a>
      <a href="criareventos.php"><div>Criar eventos</div></a>
    </div>
  </header>

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="99873f54-e72c-4123-be72-996bdb3ed61c-full-banner-home-site-super-liga.gif" alt="Slide 1">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="a39c69d6-08c2-4f06-b3f1-47f1e1cfde2c-linkinpark2025landing1920x720.gif" alt="Slide 2">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="661d6870-a0ef-483c-878b-fd7e55de3034-1920x720-1.jpg" alt="Slide 3">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="58492526-5b4c-425e-820c-da2d12e39a5c-dualipalanding1920x720.gif" alt="Slide 4">
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

  <footer>
    <p>&copy; 2025 - TICKETMAIS</p>
  </footer>

  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
