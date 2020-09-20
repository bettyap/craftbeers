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
  <!--Barra de Navegador (Navbar)  -->
  <nav class="navbar navbar-light bg-light">
    <a href="#" class="btn-abrir">&#9776;</a>
    <a href="index.html" class="navbar-brand mb-0 h1">Craft Beers</a>   
  </nav>
  <nav class="menu">      
      <a href="#">&times;</a>
      <a href="#">Categoria</a>
      <a href="#">Processos</a>
      <a href="logout.php">Sair</a> 
  </nav>
  <!--Final do navbar-->
  <!-- Cadastrar categoria da cerveja -->
<form action="criar-categoria.php" method="POST" class="center-form">
  <h2 class="form-title">NOVA CATEGORIA</h2>
    <div class="col-6">
        <input type="text" name="descricao" class="form-control" placeholder="Descrição">
    </div>
  <div class="row justify-content-center">
    <button type="submit" class="btn btn-outline-primary">Cadastrar</button>  
  </div>
</form>

<!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html> 