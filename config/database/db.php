<?php

function conectar()
{
  $usuario = "root";
  $password = "";
  $servidor = "localhost";
  $db = "cafeteria";
  $con = new mysqli($servidor, $usuario, $password, $db);

  if ($con->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
  }

  return $con;
  // // echo $con->host_info . "\n";

  // $resultado = $con->query("SELECT * FROM productos");

  // $resultado->data_seek(0);
  // while ($fila = $resultado->fetch_assoc()) {
  //     echo " id = " . $fila['ID'] . "\n";
  // }
}