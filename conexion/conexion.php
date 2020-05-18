<?php
class Conexion{
  $mysqli = new mysqli("localhost", "root", "", "spoc_bd");
  if ($mysqli->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
 public function consulta($query){
    return mysqli_query($mysqli,$query);
  }
}//class Conexion