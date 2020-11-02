<?php 

  session_start();
  include('verifica_login.php');
  include('conexao.php');

  $etapa_producao_id = $_POST['etapa_producao_id'];

  $query = "
    ALTER EVENT etapa_producao_{$etapa_producao_id} DISABLE;
  ";

  $result = mysqli_query($conexao, $query);
  
  if ($result) {
    header('Location: painel.php');
    exit();
  } else {
    echo "Houve um erro ao pausar a produção, tente novamente.";
    exit();
  }

?>