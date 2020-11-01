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
  <script type="text/javascript" src="js/timer.js"></script>
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
      <h2>Olá, <?php echo $_SESSION['usuario'];?></h2>
      <!-- Produção -->
      <form action="#" method="POST" class="center-form">
        <h2 class="form-title">Categoria</h2>
        <div class="row form-field">
          <div class="col-12">
            <div class="form-group">
              <label for="categoria">Escolha a categoria:</label>
              <select class="custom-select select" name="categoria">
                <option value="pilsen">Pilsen</option>
                <option value="teste">Teste</option>
                <option value="teste2">Teste2</option>
              </select>
            </div>
            <br>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-outline-primary">Iniciar Produção</button>
            </div>
          </div>
        </div>
      </form>
      <form action="#" method="POST" class="center-form">
        <h2 class="form-title">PRODUÇÃO</h2>
        <div class="row form-field">
          <div class="col-12">
            <div class="form-group">
              <label for="categoria">Processo:</label>
              <select class="custom-select select" name="categoria">
                <option value="pilsen">Fermentação</option>
                <option value="teste">Moagem</option>
                <option value="teste2">Broagem</option>
              </select>
            </div>
            <br>
            <div class="relogio">
              <div id="timer">
                <span id="hours"></span>Horas
                <span id="minutes"></span>Minutos
                <span id="seconds"></span>Segundos
              </div>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-outline-primary">Recomeçar</button>
              <button type="submit" class="btn btn-outline-primary">Pausar Processo</button>
              <button type="submit" class="btn btn-outline-primary">Próximo Processo</button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>