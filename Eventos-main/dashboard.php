<?php
session_start();
require 'classes/bd.php';


$eventos = $collection->find()->toArray();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - TICKETMAIS</title>
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
      margin-top: 30px;
      max-width: 900px;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    table {
      margin-top: 20px;
    }
    footer {
      background-color: #4d56dd;
      color: white;
      padding: 15px 40px;
      text-align: center;
      margin-top: 40px;
      border-radius: 0 0 12px 12px;
    }
  </style>
</head>
<body>

<header>
  <div class="ticketmais">TICKETMAIS</div>
  <div>
   <a href="home.php" class="btn btn-light btn-sm">Voltar</a>

  </div>
</header>

<div class="container">
  <div class="card">
    <h2>Seus Eventos</h2>
    <a href="criarevento.php" class="btn btn-primary mb-3">Criar Novo Evento</a>

    <?php if (count($eventos) === 0): ?>
      <p>Você ainda não criou nenhum evento.</p>
    <?php else: ?>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Tema</th>
            <th>Data</th>
            <th>Localização</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($eventos as $evento): ?>
          <tr>
            <td><?= htmlspecialchars($evento['tema'] ?? 'Sem tema') ?></td>
            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($evento['data_evento'] ?? ''))) ?></td>
            <td><?= htmlspecialchars($evento['localizacao'] ?? '-') ?></td>
            <td>
              <a href="editar.php?id=<?= $evento['_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <form action="excluir.php" method="POST" style="display:inline" onsubmit="return confirm('Confirma excluir este evento?');">
                <input type="hidden" name="id" value="<?= $evento['_id'] ?>">
                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
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
