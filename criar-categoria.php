<?php

  session_start();
  include('conexao.php');

  // criar uma variavel que recebe os dados da sessao
  $dados = $_SESSION['dados'];

  $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

  $query = "INSERT INTO categoria (descricao, usuario_id) VALUES ('{$descricao}', '{$dados['id']}');";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    header('Location: lista-categorias.php');
    exit();
  } else {
    // Mostrar erro 
    header('Location: criar-categoria.html');
    exit();
  }

?>
