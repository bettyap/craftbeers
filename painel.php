<?php
  session_start();
  include('verifica_login.php');
  include('conexao.php');
  include('db-lista-categoria.php');

  $dados = $_SESSION['user'];  

  $query_etapa_producao = "
    SELECT ep.id, pr.id, cat.id, pr.nome, ep.tempo_restante FROM etapa_producao as ep
    INNER JOIN usuario AS us ON ep.id_usuario = us.id
    INNER JOIN processo AS pr ON ep.id_processo = pr.id
    INNER JOIN categoria AS cat ON pr.id_categoria = cat.id
    WHERE us.id = {$dados['id']};
  ";

  $result_etapa_producao = mysqli_query($conexao, $query_etapa_producao);
  $existe_etapa_producao = mysqli_num_rows($result_etapa_producao);

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
  <link rel="stylesheet" type="text/css" href="css/botoes.css">
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
      <h2>Olá, <?php echo $_SESSION['user']['nome'];?></h2>
      <!-- Produção -->

      <?php if (!$existe_etapa_producao) { ?>

      <form action="<?php echo $form_action ?>" method="POST" class="center-form">
        <h2 class="form-title">Produção</h2>
        <p>Para iniciar a produção da sua cerveja, primeiro escolha a categoria de cerveja e o processo pelo qual será
          iniciado.</p>
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
              <button type="submit" class="btn btn-sucesso btn-primary">Ok</button>
            </div>
            <?php } ?>

            <?php if ($categoria_escolhida) { ?>
            <?php if (count($processos) > 0) { ?>
            <input type="hidden" name="categoria_id" value="<?php echo $categoria_escolhida ?>" />
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
            <br />
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-sucesso btn-outline-primary">Iniciar Produção</button>
            </div>
            <?php } else { ?>
            <p>Crie primeiro um processo para essa categoria, antes de iniciar a produção!</p>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
      </form>
      <?php } else { ?>

      <?php 
          $etapa_producao_row = mysqli_fetch_array($result_etapa_producao);

          $etapa = [
            'etapa_producao_id' => $etapa_producao_row[0],
            'processo_id' => $etapa_producao_row[1],
            'categoria_id' => $etapa_producao_row[2],
            'processo_nome' => $etapa_producao_row[3],
            'tempo_restante' => $etapa_producao_row[4],
          ];  

          $query = "
            SHOW EVENTS FROM craftbeers WHERE name = 'etapa_producao_{$etapa['etapa_producao_id']}';
          ";

          $result = mysqli_query($conexao, $query);
          $row = mysqli_fetch_array($result);
          
          $pausado = false;

          if ($row) {
            $pausado = $row[10] !== 'ENABLED';
          }

          $query = "
            SELECT proc.id, proc.tempo FROM processo AS proc
            INNER JOIN categoria AS cat ON cat.id = proc.id_categoria
            WHERE proc.id > {$etapa['processo_id']} ORDER BY proc.id LIMIT 1;
          ";

          $result_processo = mysqli_query($conexao, $query);
          $tem_proximo_processo = mysqli_num_rows($result_processo);

        ?>

      <form method="POST" class="center-form">
        <input type="hidden" name="etapa_producao_id" value="<?php echo $etapa['etapa_producao_id'] ?>" />
        <input type="hidden" name="processo_id" value="<?php echo $etapa['processo_id'] ?>" />
        <input type="hidden" name="categoria_id" value="<?php echo $etapa['categoria_id'] ?>" />
        <?php if ($tem_proximo_processo) { ?>
        <?php 
            $proximo_processo = mysqli_fetch_array($result_processo);
          ?>
        <input type="hidden" name="proximo_processo_id" value="<?php echo $proximo_processo[0] ?>" />
        <input type="hidden" name="proximo_processo_tempo" value="'<?php echo $proximo_processo[1] ?>'" />
        <?php } ?>
        <h2 class="form-title">Produção em andamento</h2>
        <div class="row form-field">
          <div class="col-12">
            <div class="form-group">
              <h5>Processo atual: <?php echo $etapa['processo_nome'] ?></h5>
            </div>
            <br>

            <p>
              Tempo restante do processo:
              <strong id="timer" data-pausado="<?php echo $pausado ?>"
                data-tempo-inicial="<?php echo $etapa['tempo_restante'] ?>" />
            </p>

            <div class="row justify-content-center">
              <button id="btn-reinicia" formaction="painel-reinicia-processo.php" type="submit"
                class="btn btn-sucesso btn-outline-primary" style="margin-right: 8px">
                <?php echo $etapa['tempo_restante'] === '00:00:00' ? 'Finalizar' : 'Cancelar' ?>
              </button>´
              <?php if ($etapa['tempo_restante'] !== '00:00:00') { ?>
              <button id="btn-pausa"
                formaction="<?php echo $pausado ? 'painel-resume-processo.php' : 'painel-pausa-processo.php' ?>"
                type="submit" class="btn btn-sucesso btn-outline-primary" style="margin-right: 8px">
                <?php echo $pausado ? 'Continuar' : 'Pausar' ?>
              </button>
              <?php } ?>
              <?php if ($tem_proximo_processo) { ?>
              <button formaction="painel-proximo-processo.php" type="submit"
                class="btn btn-sucesso btn-outline-primary">
                Próximo
              </button>
              <?php } ?>
            </div>
          </div>
        </div>
      </form>
      <?php } ?>
    </div>
  </main>

  <!-- JQuery, Bootstrap -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/timer.js"></script>
</body>

</html>