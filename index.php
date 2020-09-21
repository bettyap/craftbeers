<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Craft Beers</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <!--Barra de Navegador (Navbar)-->
  <nav class="navbar navbar-light bg-light">
    <a href="index.html" class="navbar-brand mb-0 h1">Craft Beers</a>
    <a class="btn btn-outline-success my-2 my-sm-0" href="cadastro.html">Registrar-se</a>
  </nav>
  <!--Final do navbar-->

  <!--Avatar-->
  <section class="wrapper-avatar">
      <div class="avatar"></div>
  </section>

<!-- Formulário de Login-->
<div class="wrapper">
  <?php 
    // if(isset($_SESSION['cadastro_sucesso'])):
  ?>
  <!-- <div class="alert alert-success" role="alert">
    Cadastro realizado com sucesso!
  </div> -->
  <?php
    // endif;
    unset($_SESSION['cadastro_sucesso']);
  ?>
  <form action="login.php" method="POST" class="form-signin"> 
    <div class="row form-field">
      <input type="text" class="form-control" name="usuario" placeholder="Email Address" required="" autofocus="" />
    </div> 
    <div class="row form-field">
      <input type="password" class="form-control" name="senha" placeholder="Password" required=""/>      
    </div>   
        <label class="checkbox">
          <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Lembre-me
        </label>
    <div class="row justify-content-center">
        <button type="submit" class="btn btn-outline-primary">Login</button>  
    </div>
    <?php
    if(isset($_SESSION['nao_autenticado'])):
    ?>
    <p>OCORREU UM ERRO USUARIO OU SENHA INVÁLIDA </p> 
    <?php
    endif;
    unset($_SESSION['nao_autenticado']);
    ?>
</form>
</div>
<?php

?>

<!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html> 
