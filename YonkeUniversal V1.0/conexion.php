<?php

    $servidor = "10.20.3.179";
    $usuario = "admin";
  	$contrasena = "Adminpato";
  	$dbnombre = "tienda";

	$conexion = new mysqli($servidor, $usuario, $contrasena, $dbnombre);
      if($conexion->connect_error){
        die("La conexión ha fallado, error número " . $db->connect_errno . ": " . $db->connect_error);
      }


?>