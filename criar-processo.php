<?php

  session_start();
  include('conexao.php');

  // criar uma variavel que recebe os dados da sessao
  $dados = $_SESSION['dados'];

  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
  $tempo = mysqli_real_escape_string($conexao, $_POST['tempo']);
  $categoriaId = $_POST['categoria'];
  $usuarioId = $dados['id'];

  $query = "INSERT INTO processo (nome, tempo, id_categoria, id_usuario) VALUES ('{$nome}', '{$tempo}', {$categoriaId}, {$usuarioId});";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    header("Location: editar-categoria.php?id={$categoriaId}");
    exit();
  } else {
    // Mostrar erro
    //header('Location: editar-categoria.php');
    echo "Não foi possível cadastrar o processo, tente mais tarde! Volte para a página anterior";
    exit();
  }

?>