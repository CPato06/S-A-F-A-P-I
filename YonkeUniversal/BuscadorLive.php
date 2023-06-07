<?php
    require_once "conexion.php";

    $salida = "";

    $stmt = $conexion->prepare("SELECT * FROM tbautos INNER JOIN imagenes ON tbautos.id = imagenes.idAuto AND imagenes.numero=1 ORDER BY id DESC");

    if (isset($_POST['consulta'])) {
    	$buscador = $conexion->real_escape_string($_POST['consulta']);
        
    	$stmt = $conexion->prepare("SELECT * FROM tbautos INNER JOIN imagenes ON tbautos.id = imagenes.idAuto WHERE tbautos.nombreauto LIKE ? AND imagenes.numero=1");
        $varBuscador = '%'.$buscador.'%';
        $stmt->bind_Param('s', $varBuscador);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows>0) {
        
    	while ($fila = $resultado->fetch_assoc()) {
            $salida.="<div class='card'>
                        <div class='img-box'>
                            <img src='img/autos/".$fila['id']."/".$fila['nombre']."' alt=''>
                        </div>
                        <h4>".$fila['nombreauto']."</h4>
                        
                        <p>
                            <strong>Motor:</strong><br> ".$fila['Motor']."<br>
                            <strong>Transmision:</strong><br> ".$fila['transmision']."<br>
                            <strong>Cilindros:</strong><br> ".$fila['cilindros']."
                        </p>
                        
                        <div class='btnPopUp'>
                        <a href='javascript:void(0)' onclick='mostrarDetalles(".$fila['id'].")'>Ver mas</a>
                        </div>
                       </div>";
    	}
    
    }
    else{
    	$salida.="<h2>No se encontraron resultados.</h2>";
    }


    echo $salida;

    $conexion->close();
?>


