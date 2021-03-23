<?php
  function connexion(){
    $co = mysqli_connect("localhost", "root", "Feel2019") or 
      die("Erreur de connexion");
    mysqli_select_db($co, "it94");
  return($co);
  }
?>