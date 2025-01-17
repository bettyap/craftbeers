<?php
  session_start();
  include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Craft Beers</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/botoes.css">
</head>

<body>
  <!--Barra de Navegador (Navbar)  -->
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand mb-0 h1">Craft Beers</a>
  </nav>
  <nav class="menu">
    <a href="painel.php">Painel</a>
    <a href="lista-categorias.php">Categoria</a>
    <a href="logout.php">Sair</a>
  </nav>
  <!--Final do navbar-->
  <main class="content">
    <div class="card card-padding">
      <!-- Cadastrar categoria da cerveja -->
      <form action="criar-categoria-post.php" method="POST" class="center-form">
        <h2 class="form-title">NOVA CATEGORIA</h2>
        <div class="col-6">
          <input type="text" name="descricao" class="form-control" placeholder="Descrição">
        </div>
        <br>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-sucesso btn-outline-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>