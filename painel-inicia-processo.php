<?php

  session_start();
  include('verifica_login.php');
  include('conexao.php');

  $dados = $_SESSION['dados']; 

  $categoriaId = $_POST['categoria_id'];
  $processoId = $_POST['processo_id'];

  $query_processo = "select id, nome, tempo from processo where id = '{$processoId}';";
  $result_processo = mysqli_query($conexao, $query_processo);
  $row_processo = mysqli_num_rows($result_processo);

  if ($row_processo < 1) {
    echo "Processo não encontrado, volte e tente novamente!";
    exit();
  }

  $dados_row = mysqli_fetch_array($result_processo);

  $processo = [
    'id' => $dados_row[0],
    'nome' => $dados_row[1],
    'tempo' => $dados_row[2],
  ];

  $query_insere_processo = "insert into etapa_producao (id_usuario, id_processo, tempo_restante)
  values ('{$dados['id']}', '{$processo['id']}', '{$processo['tempo']}');";

  $result_insere_processo = mysqli_query($conexao, $query_insere_processo);

  $id_etapa_producao = mysqli_insert_id($conexao);

  if (!$result_insere_processo) {
    echo "Houve um erro ao iniciar a produção volte e tente novamente";
    exit();
  }

  $query_evento = "
    CREATE EVENT etapa_producao_{$id_etapa_producao}
    ON SCHEDULE EVERY 1 MINUTE
    STARTS CURRENT_TIMESTAMP
    ENDS CURRENT_TIMESTAMP + INTERVAL '{$processo['tempo']}' HOUR_SECOND
    DO
    UPDATE etapa_producao SET tempo_restante=(
      SELECT DATE_SUB(tempo_restante, INTERVAL 1 minute) FROM etapa_producao WHERE id = {$id_etapa_producao}
    ) WHERE id = {$id_etapa_producao};
  ";

  $result_evento = mysqli_query($conexao, $query_evento);

  header('Location: painel.php');
  exit();

?>