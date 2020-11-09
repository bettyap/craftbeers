<?php
  // criar uma variavel que recebe os dados da sessao
  $dados = $_SESSION['user'];  

  $query = "SELECT cat.id, cat.descricao FROM categoria AS cat INNER JOIN usuario AS usu ON usu.id = cat.usuario_id WHERE usu.id = '{$dados['id']}';";

  $result = mysqli_query($conexao, $query);

  // criar um array vazio
  $categorias = [];
  // cria uma variavel para controlar a posição/index
  $i = 0;

  // enquanto tiver rows no resultado, faça:
  // $dados_row vai ter o conteudo de cada linha
  while($dados_row = mysqli_fetch_array($result)) {
    // Acessa a posicao $i de dados e preenche com os dados daquela linha
    // onde $i começa como 0, e aumenta de 1 em 1 em dada volta do loop
    $categorias[$i] = [
      // pega a primeira entrada do $dados_row, que é o id
      'id' => $dados_row[0],
      'descricao' => $dados_row[1],
    ];

    // soma +1 no $i
    $i++;
  }

?>