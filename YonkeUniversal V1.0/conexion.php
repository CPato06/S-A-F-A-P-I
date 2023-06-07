<?php

    $servidor = "localhost";
    $usuario = "u718113309_yonkeuniversal";
  	$contrasena = "TcQKZFI?mU2#";
  	$dbnombre = "u718113309_yonkedb";

	$conexion = new mysqli($servidor, $usuario, $contrasena, $dbnombre);
      if($conexion->connect_error){
        die("La conexión ha fallado, error número " . $db->connect_errno . ": " . $db->connect_error);
      }


?>