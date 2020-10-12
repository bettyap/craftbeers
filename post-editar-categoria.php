<?php
session_start();
include('conexao.php');

// criar uma variavel que recebe os dados da sessao
$dados = $_SESSION['dados'];

$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);




?>