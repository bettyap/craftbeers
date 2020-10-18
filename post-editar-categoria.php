<?php
session_start();
include('conexao.php');

$categoriaId = $_POST['categoriaId'];
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

$query = "UPDATE categoria SET descricao='{$descricao}' WHERE id = {$categoriaId};";

$result = mysqli_query($conexao, $query);

if (!$result) {
  echo "Não foi possivel editar a categoria {$categoriaId} com sucesso, tente novamente mais tarde.";
  exit();
}

$processos = $_POST['processos'];

foreach ($processos as $processo) {

  $processoId = $processo['id'];
  $nome = mysqli_real_escape_string($conexao, $processo['nome']);
  $tempo = mysqli_real_escape_string($conexao, $processo['tempo']);

  $query = "UPDATE processo SET nome = '{$nome}', tempo = '{$tempo}' WHERE id = {$processoId};";

  $result = mysqli_query($conexao, $query);

  if (!$result) {
    echo "Não foi possivel editar o processo {$processoId} com sucesso, tente novamente mais tarde.";
    exit();
  }

}

header("Location: editar-categoria.php?id={$categoriaId}");
exit();

?>