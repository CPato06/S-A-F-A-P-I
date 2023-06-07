<?php

    $servidor = "database-api.cdjnyiihv9g0.us-east-2.rds.amazonaws.com";
    $usuario = "admin";
  	$contrasena = "Adminpato";
  	$dbnombre = "tienda";

	$conexion = new mysqli($servidor, $usuario, $contrasena, $dbnombre);
      if($conexion->connect_error){
        die("La conexión ha fallado, error número " . $db->connect_errno . ": " . $db->connect_error);
      }


?>