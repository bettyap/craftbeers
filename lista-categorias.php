<?php

  session_start();
  include('conexao.php');

  // criar uma variavel que recebe os dados da sessao
  $dados = $_SESSION['dados'];  

  $query = "SELECT cat.id, cat.descricao FROM categoria AS cat INNER JOIN usuario AS usu ON usu.id = cat.usuario_id WHERE usu.id = '{$dados['id']}';";

  $result = mysqli_query($conexao, $query);

  // criar um array vazio
  $dados = [];
  // cria uma variavel para controlar a posição/index
  $i = 0;

  // enquanto tiver rows no resultado, faça:
  // $dados_row vai ter o conteudo de cada linha
  while($dados_row = mysqli_fetch_array($result)) {
    // Acessa a posicao $i de dados e preenche com os dados daquela linha
    // onde $i começa como 0, e aumenta de 1 em 1 em dada volta do loop
    $dados[$i] = [
      // pega a primeira entrada do $dados_row, que é o id
      'id' => $dados_row[0],
      'descricao' => $dados_row[1],
    ];

    // soma +1 no $i
    $i++;
  }

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
  <!--Barra de Navegador (Navbar)  
  <nav class="navbar navbar-light bg-light">
    <a href="#" class="btn-abrir">&#9776;</a>
    <a href="index.html" class="navbar-brand mb-0 h1">Craft Beers</a>   
  </nav>
  <nav class="menu">      
      <a href="#">&times;</a>
      <a href="#">Categoria</a>
      <a href="#">Processos</a>
      <a href="logout.php">Sair</a> 
  </nav> -->
  <!--Final do navbar-->
  <!-- Cadastrar categoria da cerveja -->
<form class="center-form">
  <h2 class="form-title">CATEGORIAS</h2>  
  <div class="lista-categorias">
    
    <?php
      foreach ($dados as $categoria) {
    ?>
      <a href="categoria.php?id=<?php echo $categoria['id'] ?>" class="card categoria-card">
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
</form>
<div class="row justify-content-center">
  <a href="criar-categoria.html" class="btn btn-outline-primary">Nova Categoria</a>  
</div>

<!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html> 