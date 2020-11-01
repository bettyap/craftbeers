<?php

  session_start();
  include('conexao.php');

  $id = $_REQUEST['id'];

  if($id !=null)
  {
    $query = "DELETE FROM categoria WHERE id=42";
    mysqli_query($query) or die ($query."<br>".mysqli_error());
    header('Location:lista-categorias.php');
  } 
  var_dump($query);
  ?>