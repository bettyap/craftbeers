<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: painel.php');
  exit();
}

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
    <a class="btn btn-sucesso btn-outline-success my-2 my-sm-0" href="cadastro.php">Registrar-se</a>
  </nav>
  <!--Final do navbar-->
  <!--Avatar-->
  <section class="wrapper-avatar">
    <div class="avatar"></div>
  </section>
  <!-- Formulário de Login-->
  <div class="wrapper">
    <?php 
      if(isset($_SESSION['cadastro_sucesso'])) {
    ?>
    <div class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto;">
      Cadastro realizado com sucesso!
    </div>
    <?php
      }
      unset($_SESSION['cadastro_sucesso']);
    ?>
    <?php
      if(isset($_SESSION['nao_autenticado'])) {
    ?>
    <div class="alert alert-danger" role="alert" style="width: 300px; margin: 0 auto;">
      Usuário ou senha inválidos!
    </div>
    <?php
      }
      unset($_SESSION['nao_autenticado']);
    ?>
    <form action="login.php" method="POST" class="form-signin">
      <div class="row form-field">
        <input type="text" class="form-control" name="usuario" placeholder="Email " required="" autofocus="" />
      </div>
      <div class="row form-field">
        <input type="password" class="form-control" name="senha" placeholder="Senha" required="" />
      </div>
      <div class="row justify-content-center">
        <button type="submit" class="btn btn-primeiro btn-outline-primary">Login</button>
      </div>
    </form>
  </div>


  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>