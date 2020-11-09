<?php

  session_start();
  include('conexao.php');

  $categoriaId = $_GET['categoriaId'];
  

    $query = 
    "DELETE FROM processo WHERE id_categoria = {$categoriaId}; 
     DELETE FROM categoria WHERE id = {$categoriaId};
     ";
     
    $result = mysqli_multi_query($conexao, $query); 


    header("Location: lista-categorias.php");
    exit();
    ?>