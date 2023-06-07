<?php
    session_start();
    $usuario = $_SESSION['user'];

    if(!isset($usuario)){
        header("location: ../");
    }

    include_once '../conexion.php';
    $id = $_POST['id'];

    if(isset($id)){
        $directorio = "../img/autos/$id/";

        $stmt_select = $conexion->prepare("SELECT nombre FROM imagenes WHERE idAuto = ?");
        $stmt_select->bind_Param('i', $id);
        $stmt_select->execute();
        
        $resultado = $stmt_select->get_result();
        while($imgRow = $resultado->fetch_assoc()) {

            unlink($directorio.$imgRow['nombre']);
        }
        
        rmdir($directorio);
        
        $stmt_delete = $conexion->prepare("DELETE FROM tbautos WHERE id = ?");
        $stmt_delete->bind_Param('i', $id);
        $stmt_delete->execute();
        
        $stmt_delete->close();
        $stmt_select->close();
        $conexion->close();
    }

?>