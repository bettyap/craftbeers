<?php 

session_start();
include('verifica_login.php');
include('conexao.php');

//Pega a categoria id atraves do parametro na url utilizando o GET
$categoriaid = $_GET['id'];

// criar uma variavel que recebe os dados da sessao
$dados = $_SESSION['dados'];  

$query_cat = "SELECT * FROM categoria WHERE id ='{$categoriaid}';";
$result_cat = mysqli_query($conexao, $query_cat);
$row_cat = mysqli_num_rows($result_cat);

if($row_cat == 1) {

  // pegar os dados
  $dados_row_cat = mysqli_fetch_array($result_cat);

  $dados_cat = [
    'id' => $dados_row_cat[0],
    'descricao' => $dados_row_cat[2],
  ];

} else {
  echo "<p>Categoria não existente!</p>";
  exit();
}


$query = "SELECT proc.id, proc.nome, proc.tempo FROM processo AS proc
INNER JOIN usuario AS usu  ON usu.id = proc.id_usuario 
INNER JOIN categoria AS cat ON cat.id = proc.id_categoria
WHERE usu.id = '{$dados['id']}' AND cat.id = '{$categoriaid}';";

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
    'nome' => $dados_row[1],
    'tempo' => $dados_row[2],
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
      <form action="post-editar-categoria.php" method="POST" class="categoria-form">
        <h2 class="form-title">EDITAR CATEGORIA</h2>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="descricao" class="form-control" value="<?php echo $dados_cat['descricao'] ?>">
          </div>
        </div>
        <br>
        <!-- Listagem dos Processos -->
        <h4 class="form-title">Processos</h4>
        <?php
            foreach ($dados as $processo) {
          ?>
        <div class="row form-field">
          <div class="col-6">
            <input type="text" name="nome" class="form-control" placeholder="Nome"
              value="<?php echo $processo['nome'] ?>">
          </div>
          <div class="col-6">
            <input type="time" name="tempo" class="form-control" placeholder="Tempo"
              value="<?php echo $processo['tempo'] ?>">
          </div>
        </div>
        <?php
            } 
          ?>

        <div class="row justify-content-center">
          <button type="submit" class="btn btn-outline-primary">Atualizar</button>
        </div>
      </form>
      <br>
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
              <a href="criar-processo.php" button type="button" class="btn btn-primary">Salvar</a></button>
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