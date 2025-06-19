<?php
if (isset($_GET['ok'])) {
    echo "<script>alert('Evento criado com sucesso!');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Criar Evento - TICKETMAIS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f7f9fc;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      background-color: #4d56dd;
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .ticketmais {
      font-size: 24px;
      font-style: italic;
      font-weight: bold;
    }

    .container {
      margin-top: 40px;
      max-width: 800px;
    }

    .card {
      padding: 30px;
      border: none;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      background: white;
    }

    .card h2 {
      color: #4d56dd;
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: 600;
      color: #333;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-submit {
      background-color: #4d56dd;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #3c47b7;
    }

    footer {
      background-color: #4d56dd;
      color: white;
      padding: 20px 40px;
      text-align: center;
      bottom: 0;
      width: 100%;
    }

    @media (max-width: 576px) {
      header, footer {
        text-align: center;
        flex-direction: column;
      }
    }

    .btn-group {
      display: inline-flex;
      gap: 10px;
      justify-content: center;
    }
  </style>
</head>
<body>

<header>
  <div class="ticketmais">TICKETMAIS</div>
  <a href="home.php" class="btn btn-light">Voltar</a>
</header>

<div class="container">
  <div class="card">
    <h2 class="text-center">Criar Novo Evento</h2>
    <form method="POST" action="salvareventos.php">
      <div class="form-group">
        <label for="tema">Tema</label>
        <input type="text" class="form-control" name="tema" id="tema" required>
      </div>
      <div class="form-group">
        <label for="descricao_evento">Descrição do Evento</label>
        <textarea class="form-control" name="descricao_evento" id="descricao_evento" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="data_evento">Data do Evento</label>
        <input type="datetime-local" class="form-control" name="data_evento" id="data_evento" required>
      </div>
      <div class="form-group">
        <label for="promotor">Promotor</label>
        <input type="text" class="form-control" name="promotor" id="promotor" required>
      </div>
      <div class="form-group">
        <label for="localizacao">Localização</label>
        <input type="text" class="form-control" name="localizacao" id="localizacao" required>
      </div>
      <div class="form-group">
        <label for="vagas_totais">Vagas Totais</label>
        <input type="number" class="form-control" name="vagas_totais" id="vagas_totais" required>
      </div>

      <div class="text-center btn-group">
        <button type="submit" class="btn btn-submit">Criar Evento</button>
        <button type="reset" class="btn btn-secondary">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<footer>
  <p>&copy; 2025 - TICKETMAIS</p>
</footer>

</body>
</html>
