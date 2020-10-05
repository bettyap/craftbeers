<?php 

include('conexao.php');

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
      <form action="criar-categoria.php" method="POST" class="center-form">
        <h2 class="form-title">EDITAR CATEGORIA</h2>
        <div class="col-6">
          <input type="text" name="descricao" class="form-control" placeholder="Descrição">
        </div>
        <br>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
        </div>
      </form>
      <!-- Listagem dos Processos -->
      <form action="" method="POST" class="center-form">
        <h2 class="form-title">PROCESSO</h2>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
          </div>
          <div class="col-6">
            <input type="time" name="tempo" class="form-control" placeholder="Tempo">
          </div>
        </div>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
          </div>
          <div class="col-6">
            <input type="time" name="tempo" class="form-control" placeholder="Tempo">
          </div>
        </div>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
          </div>
          <div class="col-6">
            <input type="time" name="tempo" class="form-control" placeholder="Tempo">
          </div>
        </div>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
          </div>
          <div class="col-6">
            <input type="time" name="tempo" class="form-control" placeholder="Tempo">
          </div>
        </div>
      </form>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Novo processo
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Novo Processo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row form-field">
                <div class="col-6">
                  <input type="text" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div class="col-6">
                  <input type="time" name="tempo" class="form-control" placeholder="Tempo">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>