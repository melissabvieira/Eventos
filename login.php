<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - TICKETMAIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            background-color: #f0f0f0;
        }

        header {
            background-color: #4d56dd;
            color: white;
            padding: 30px 40px;
            position: fixed;
            top: 0;
            width: 100%;
            text-align: center;
            z-index: 1000;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .btn-primary {
            background-color: #4d56dd;
            border-color: #4d56dd;
        }
    </style>
</head>
<body>

<header>
    <h2>TICKETMAIS - Login</h2>
</header>

<div class="login-container">
    <form action="verifica_login.php" method="post">
        <div class="form-group">
            <label>Usuário:</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>

        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger mt-3 text-center">Usuário ou senha inválidos!</div>
        <?php endif; ?>
    </form>
</div>

<footer>
    <p>&copy; 2025 - TICKETMAIS</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
