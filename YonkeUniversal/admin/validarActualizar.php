<?php

    require_once("../conexion.php");
    require_once("funciones.php");

    session_start();
    $usuario = $_SESSION['user'];

    if(!isset($usuario)){
        header("location: ../");
    }

    if(isset($_POST['update'])){
        $idAuto = filtrado($_POST['id_registro']);
        
        $id_usuario = filtrado($_POST['usuario']);
        $nombreauto = filtrado($_POST['nombreauto']);
        $marca = filtrado($_POST['marca']);
        $modelo = filtrado($_POST['modelo']);
        $anio = filtrado($_POST['anio']);
        $estado = filtrado($_POST['estado']);
        $cilindros = filtrado($_POST['cilindros']);
        $Motor = filtrado($_POST['Motor']);
        $transmision = filtrado($_POST['transmision']);
        
        if($stmt_update = $conexion->prepare("UPDATE tbautos SET usuario=?, nombreauto=?, marca=?, modelo=?, anio=?, estado=?, cilindros=?, Motor=?, transmision=? WHERE id=?")){
            $stmt_update->bind_param("isssssissi", $id_usuario, $nombreauto, $marca, $modelo, $anio, $estado, $cilindros, $Motor, $transmision, $idAuto);
            $stmt_update->execute();

            $carpeta = "../img/autos/$idAuto/";
            crearCarpeta($carpeta);

            for($i=1; $i <= count($_FILES); $i++){
                if($_FILES['foto_'.$i]['size']> 0){
                    if ($_FILES['foto_'.$i]['type']=='image/png' || $_FILES['foto_'.$i]['type']=='image/jpeg') {

                        $stmt_select = $conexion->prepare("SELECT nombre FROM imagenes WHERE idAuto = ? AND numero = ?");
                        $stmt_select->bind_Param('ii', $idAuto, $i);
                        $stmt_select->execute();

                        $resultado = $stmt_select->get_result();
                        $imgRow = $resultado->fetch_assoc();

                        if($_FILES['foto_'.$i]['name'] !== $imgRow['nombre']){
                            
                            $extension = pathinfo($_FILES["foto_$i"]["name"], PATHINFO_EXTENSION);
                            $nuevo_nombre = "auto_".date("Ymd_his")."$i.".$extension;
                            $nueva_direccion = $carpeta.basename($nuevo_nombre);

                             move_uploaded_file($_FILES["foto_$i"]["tmp_name"], $nueva_direccion);

                            $imagen_optimizada = redimensionar_imagen($nuevo_nombre,$nueva_direccion,550,800);
                            imagejpeg($imagen_optimizada, $nueva_direccion);
                            imagedestroy($imagen_optimizada);

                            if($resultado->num_rows == 0){
                                $stmt = $conexion->prepare("INSERT INTO imagenes (idAuto,nombre,numero) VALUES (?, ?, ?)");
                                $stmt->bind_param('isi', $idAuto,$nuevo_nombre,$i);
                                $stmt->execute();
                            }

                            if($resultado->num_rows !== 0){

                                eliminarFoto($carpeta.$imgRow['nombre']);

                                $stmt = $conexion->prepare("UPDATE imagenes SET nombre=? WHERE idAuto=? AND numero = ?");
                                $stmt->bind_param('sii', $nuevo_nombre, $idAuto, $i);
                                $stmt->execute();
                            }
                            
                            echo  json_encode(['titulo'=>'Se actualizaron los datos correctamente!',
                                               'estado'=>true]);
                        } else {
                            echo  json_encode(['titulo'=>'Los datos fueron actualizados pero no las imagenes!',
                                               'mensaje'=>'No se permiten imagenes duplicadas',
                                               'estado'=>false]);
                        }
                    } else {
                        echo  json_encode(['titulo'=>'Los datos fueron actualizados pero no las imagenes!',
                                               'mensaje'=>'Solo se permiten archivos JPG y PNG',
                                               'estado'=>false]);
                    }
                }
            }
            echo  json_encode(['titulo'=>'Se actualizaron los datos correctamente!',
                                               'estado'=>true]);
            $conexion->close();
        } else {
            echo  json_encode(['titulo'=>'Hubo un error al actualizar los datos!',
                               'estado'=>false]);
        }
    }

?>