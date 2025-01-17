<?php 
  session_start();
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
  <!--Barra de Navegador (Navbar)-->
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand mb-0 h1">Craft Beers</a>
  </nav>
  <!--Final do navbar-->
  <main class="content sem-sidebar">
    <div class="card card-padding">
      <!-- Formulário de Cadastro -->
      <form action="post-cadastro.php" method="POST">
        <h2 class="form-title">CADASTRO</h2>
        <div class="row form-field">
          <div class="col">
            <input type="text" name="nome" class="form-control" placeholder="Nome*" maxlenght="50" required>
          </div>
        </div>
        <div class="row form-field">
          <div class="col-6">
            <input type="date" name="data_nasc" class="form-control" placeholder="Data de Nascimento*" required>
          </div>
          <div class="col-6">
            <input type="text" name="num_telefone" class="form-control" placeholder="Telefone*" maxlenght="20" required>
          </div>
        </div>
        <div class="row form-field">
          <div class="col">
            <input type="email" name="email" class="form-control" placeholder="Email*" maxlenght="50" required>
          </div>
        </div>
        <div class="row form-field">
          <div class="col">
            <input type="password" name="senha" class="form-control" placeholder="Senha*" maxlenght="15" required>
          </div>
        </div>
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