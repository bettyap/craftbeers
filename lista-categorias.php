<?php

  session_start();
  include('conexao.php');
  include('db-lista-categoria.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Craft Beers</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
      <div class="center-form card card-padding">
        <h2 class="form-title">CATEGORIAS</h2>
        <div class="lista-categorias">
          <?php
                  foreach ($categorias as $categoria) {
                ?>
          <a href="editar-categoria.php?id=<?php echo $categoria['id'] ?>" class="card categoria-card">
            <div class="card-text">
              <?php
                        echo $categoria['descricao'];
                      ?>
            </div>
          </a>
          <?php
                  }
                ?>
        </div>
        <div class="row justify-content-center">
          <a href="criar-categoria.html" class="btn btn-outline-primary">Nova Categoria</a>
        </div>
      </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>