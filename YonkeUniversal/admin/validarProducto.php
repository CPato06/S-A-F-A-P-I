<?php
    require_once("../conexion.php");
    require_once("funciones.php");

    session_start();
    $usuario = $_SESSION['user'];

    if(!isset($usuario)){
        header("location: ../");
    }

    if (isset($_POST['submit'])) {
        
        $id_usuario = filtrado($_POST['usuario']);
        $nombreauto = filtrado($_POST['nombreauto']);
        $marca = filtrado($_POST['marca']);
        $modelo = filtrado($_POST['modelo']);
        $anio = filtrado($_POST['anio']);
        $estado = filtrado($_POST['estado']);
        $cilindros = filtrado($_POST['cilindros']);
        $Motor = filtrado($_POST['Motor']);
        $transmision = filtrado($_POST['transmision']);

        if ($stmt = $conexion->prepare("INSERT INTO tbautos(usuario, nombreauto, marca, modelo, anio, estado, cilindros, Motor, transmision) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")){
            $stmt->bind_param('isssssiss', $id_usuario, $nombreauto, $marca, $modelo, $anio, $estado, $cilindros, $Motor, $transmision);
            $stmt->execute();
    
                // Iniciamos sentencia preparada
            if ($stmt = $conexion->prepare("SELECT MAX(id) as id FROM tbautos")) {
                $stmt->execute();
                // Vinculamos variables a columnas
                $stmt->bind_result($id);
                // Obtenemos los valores
                $stmt->fetch();
                // Guardamos nuestro valor
                $idAuto = $id;
                // Cerramos la sentencia preparada
                $stmt->close();
            }

            $carpeta = "../img/autos/$idAuto/";
            crearCarpeta($carpeta);

            for($i=1; $i <= count($_FILES); $i++){
                if($_FILES['foto_'.$i]['size']> 0){
                    if ($_FILES['foto_'.$i]['type']=='image/png' || $_FILES['foto_'.$i]['type']=='image/jpeg') {

                        $extension = pathinfo($_FILES["foto_$i"]["name"], PATHINFO_EXTENSION);
                        $nuevo_nombre = "auto_".date("Ymd_his")."$i.".$extension;
                        $nueva_direccion = $carpeta.basename($nuevo_nombre);

                         move_uploaded_file($_FILES["foto_$i"]["tmp_name"], $nueva_direccion);

                        $imagen_optimizada = redimensionar_imagen($nuevo_nombre,$nueva_direccion,550,800);
                        imagejpeg($imagen_optimizada, $nueva_direccion);
                        imagedestroy($imagen_optimizada);

                        $stmt = $conexion->prepare("INSERT INTO imagenes (idAuto,nombre,numero) VALUES (?, ?, ?)");
                        $stmt->bind_param('isi', $idAuto,$nuevo_nombre,$i);
                        $stmt->execute();
                        
                    } else {
                        echo  json_encode(['titulo'=>'Los datos fueron subidos pero no las imagenes!',
                                               'mensaje'=>'Solo se permiten archivos JPG y PNG',
                                               'estado'=>false]);
                    }
                } 
            }
            echo  json_encode(['titulo'=>'Se subieron los datos correctamente!',
                                           'estado'=>true]);
            $conexion->close();
        }
    }

?>