<?php 

  session_start();
  include('verifica_login.php');
  include('conexao.php');

  $etapa_producao_id = $_POST['etapa_producao_id'];
  $proximo_processo_id = $_POST['proximo_processo_id'];
  $proximo_processo_tempo = $_POST['proximo_processo_tempo'];

  // Dropar o evento anterior
  // Alterar o processo_id e o tempo_restante da etapa_producao para o novo
  // Cria novo evento com novo tempo restante
  $query = "
    DROP EVENT IF EXISTS etapa_producao_{$etapa_producao_id};
    UPDATE etapa_producao SET id_processo = {$proximo_processo_id}, tempo_restante = {$proximo_processo_tempo} WHERE id = {$etapa_producao_id};
    CREATE EVENT etapa_producao_{$etapa_producao_id}
    ON SCHEDULE EVERY 1 MINUTE
    STARTS CURRENT_TIMESTAMP
    ENDS CURRENT_TIMESTAMP + INTERVAL {$proximo_processo_tempo} HOUR_SECOND
    DO
    UPDATE etapa_producao SET tempo_restante=(
      SELECT DATE_SUB(tempo_restante, INTERVAL 1 minute) FROM etapa_producao WHERE id = {$etapa_producao_id}
    ) WHERE id = {$etapa_producao_id};
  ";

  $result = mysqli_multi_query($conexao, $query);
  
  if ($result) {
    header('Location: painel.php');
    exit();
  } else {
    echo "Houve um erro ao pausar a produção, tente novamente.";
    exit();
  }

?>