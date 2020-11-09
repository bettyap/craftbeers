<?php

  session_start();
  include('conexao.php');

  $id = $_GET['id'];
  $categoriaid = $_GET['categoriaid'];
  

    $query = "DELETE FROM processo WHERE id = {$id};";
    $result = mysqli_query($conexao, $query); 
    
    header("Location: editar-categoria.php?id={$categoriaid}");
    exit();
    ?>