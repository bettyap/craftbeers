<?php
  session_start();
  include('verifica_login.php');
  include('conexao.php');
  include('db-lista-categoria.php');

  $dados = $_SESSION['dados'];  

  //
//   SELECT * FROM etapa_producao as ep
// inner join usuario as us on ep.id_usuario = us.id
// where us.id = 1;



  $categoria_escolhida = $_POST['categoria_escolhida'] ?? null;

  $form_action = $categoria_escolhida
    ? 'painel-inicia-processo.php'
    : 'painel.php';

  if ($categoria_escolhida) {
    $query_processos = "SELECT proc.id, proc.nome, proc.tempo FROM processo AS proc
    INNER JOIN usuario AS usu  ON usu.id = proc.id_usuario 
    INNER JOIN categoria AS cat ON cat.id = proc.id_categoria
    WHERE usu.id = '{$dados['id']}' AND cat.id = '{$categoria_escolhida}';";

    $result_processos = mysqli_query($conexao, $query_processos);

    // criar um array vazio
    $processos = [];
    // cria uma variavel para controlar a posição/index
    $i = 0;

    // enquanto tiver rows no resultado, faça:
    // $dados_row vai ter o conteudo de cada linha
    while($dados_row = mysqli_fetch_array($result_processos)) {
      // Acessa a posicao $i de dados e preenche com os dados daquela linha
      // onde $i começa como 0, e aumenta de 1 em 1 em dada volta do loop
      $processos[$i] = [
        // pega a primeira entrada do $dados_row, que é o id
        'id' => $dados_row[0],
        'nome' => $dados_row[1],
        'tempo' => $dados_row[2],
      ];

      // soma +1 no $i
      $i++;
    }
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
      <form action="<?php echo $form_action ?>" method="POST" class="center-form">
        <h2 class="form-title">Minha produção</h2>
        <p>Para iniciar a produção da sua cerveja, primeiro escolha a categoria de cerveja e o processo pelo qual será iniciado.</p>
        <div class="row form-field">
          <div class="col-12">
            <?php if (!$categoria_escolhida) { ?>
              <div class="form-group">
                <label for="categoria">Escolha a categoria:</label>
                <select class="custom-select select" name="categoria_escolhida" required>
                  <?php
                    foreach ($categorias as $categoria) {
                  ?>
                  <option value="<?php echo $categoria['id'] ?>">
                    <?php echo $categoria['descricao'] ?>
                  </option>
                  <?php
                    }
                  ?>
                </select>
                <button type="submit" class="btn btn-primary">Ok</button>
              </div>
            <?php } ?>

            <?php if ($categoria_escolhida) { ?>
              <?php if (count($processos) > 0) { ?>
                <input type="hidden" name="categoria_id" value="<?php echo $categoria_escolhida ?>"/>
                <div class="form-group">
                  <label for="categoria">Escolha o processo da onde começar:</label>
                  <select class="custom-select select" name="processo_id" required>
                    <?php
                      foreach ($processos as $processo) {
                    ?>
                      <option value="<?php echo $processo['id'] ?>">
                        <?php echo $processo['nome'] ?>
                      </option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <br/>
                <div class="row justify-content-center">
                  <button type="submit" class="btn btn-outline-primary">Iniciar Produção</button>
                </div>
              <?php } else { ?>
                <p>Crie primeiro um processo para essa categoria, antes de iniciar a produção!</p>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </form>
      <!-- <form action="#" method="POST" class="center-form">
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
      </form> -->

    </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>