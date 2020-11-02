<?php 

  session_start();
  include('verifica_login.php');
  include('conexao.php');

  $etapa_producao_id = $_POST['etapa_producao_id'];

  $query_delete = "
    DELETE FROM etapa_producao WHERE id = {$etapa_producao_id};
    DROP EVENT IF EXISTS etapa_producao_{$etapa_producao_id};
  ";

  $result_delete = mysqli_multi_query($conexao, $query_delete);

  if ($result_delete) {
    header('Location: painel.php');
    exit();
  } else {
    echo "Erro ao reiniciar a produção, por favor tente mais tarde.";
    exit();
  }
?>