<?php
  session_start();
  include('conexao.php');

  //var_dump($_POST);

  //Se os campos usuario e senha estiverem vindo vazio será redirecionado ao index.php 
  if(empty($_POST['usuario']) || empty($_POST['senha'])) {
      header('Location: index.php');
      exit();
  }

  //Função que protege o ataque inject sql
  $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
  $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

  $query = "select * from usuario where email = '{$usuario}' and senha = md5('{$senha}')";

  $result = mysqli_query($conexao,$query);
  //
  
  //quantas linhas está sendo mostradas 
  $row = mysqli_num_rows($result);

  if($row == 1) {

    // pegar os dados
    $dados_row = mysqli_fetch_array($result);

    $dados = [
        'id' => $dados_row[0],
        'nome' => $dados_row[1],
        'num_telefone' => $dados_row[1],
        'senha' => $dados_row[1],
        'email' => $dados_row[1],
        'data_nasc' => $dados_row[1],   
    ];

      $_SESSION['usuario'] = $usuario;
      $_SESSION['dados'] = $dados;
      header('Location: painel.php');
      exit();
  } else {
      $_SESSION['nao_autenticado'] = true;
      header('Location: index.php');
      exit();
  }

?>
