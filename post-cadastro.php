<?php
  session_start();
  include('conexao.php');

  // verificar se os campos tem valores
  if(
    empty($_POST['nome']) ||
    empty($_POST['num_telefone']) ||
    empty($_POST['senha']) ||
    empty($_POST['email']) ||
    empty($_POST['data_nasc'])
  ) {
    header('Location: index.php');
    exit();
  }  

  // proteção contra ataque 
  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
  $num_telefone = mysqli_real_escape_string($conexao, $_POST['num_telefone']);
  $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
  $email = mysqli_real_escape_string($conexao, $_POST['email']);
  $data_nasc = mysqli_real_escape_string($conexao, $_POST['data_nasc']);

  $query = "INSERT INTO `usuario` (`nome`, `num_telefone`, `senha`, `email`, `data_nasc`) VALUES ('{$nome}', '{$num_telefone}', md5('{$senha}'), '{$email}', '{$data_nasc}')";
  // echo $query; exit;
  $result = mysqli_query($conexao, $query);
  // echo mysqli_error($conexao); exit; erro de banco ao executar $query

  if($result) {
    $_SESSION['cadastro_sucesso'] = true;
    session_write_close(); 
    header('Location: index.php');
    exit();
  } else {
    header('Location: cadastro.php');
    exit();
  }
?>