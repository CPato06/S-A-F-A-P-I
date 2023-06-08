<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro</title>
    <style>
    /* Estilos del modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 20% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Modifica el valor aquí para ajustar el ancho del modal */
        max-width: 400px; /* Agrega esta línea para limitar el ancho máximo del modal */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

</head>
<body>
    <div>    
        <h1><a href="landing_page.php" class="titulo">ShieldVerify API</a></h1>
        <hr>
    </div>
    
    <?php include('conexion.php');?>

    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Obtener datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos empresa
        $correo_empresa = $_POST['correo_empresa']; 
        $contrasena = $_POST['contrasena']; 
        $nombre_empresa = $_POST['nombre_empresa']; 

        // Realizar la inserción en la tabla Empresa
        $query = "INSERT INTO Empresa (Nombre, Correo) VALUES ('$nombre_empresa', '$correo_empresa')";
        $result = $conn->query($query);

        if ($result === TRUE) {
            // Obtener el ID generado para la empresa insertada
            $id_empresa = $conn->insert_id;

            // Datos usuario
            $nombre_usu = $_POST['nombre_usu']; 
            $ap_paterno = $_POST['ap_paterno']; 
            $ap_materno = $_POST['ap_materno']; 

            // Realizar la inserción en la tabla Usuarios
            $query2 = "INSERT INTO Usuarios (Nombre, Ap_Paterno, Ap_Materno, Correo_empresa, Contraseña, Empresa_idEmpresa, Rango_idRango) VALUES ('$nombre_usu','$ap_paterno','$ap_materno','$correo_empresa','$contrasena','$id_empresa', 1)";
            $result2 = $conn->query($query2);

            if ($result2 === TRUE) {
                echo "<script>showModal('El registro se hizo exitosamente.');</script>";
            } else {
                echo "<script>showModal('El registro no se pudo realizar.');</script>" . $conn->error;
            }
        } else {
            echo "<script>showModal('El registro no se pudo realizar.');</script>". $conn->error;
        }
    } 

    $conn->close();
    ?>

    <section class="form-registro">
        <h2 style="color: black; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
         Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Registrate gratis</h2>
        <form method="POST" action="">
            <input class="controls" type="text" id="correo_empresa" name="correo_empresa" value="" placeholder="Correo electrónico de la empresa">
            <input class="controls" type="password" id="contrasena" name="contrasena" value="" placeholder="Contraseña">
            <input class="controls" type="text" id="nombre_empresa" name="nombre_empresa" value="" placeholder="Nombre de la empresa">
            <input class="controls" type="text" id="nombre_usu" name="nombre_usu" value="" placeholder="Nombre">
            <input class="controls" type="text" id="ap_paterno" name="ap_paterno" value="" placeholder="Apellido paterno">
            <input class="controls" type="text" id="ap_materno" name="ap_materno" value="" placeholder="Apellido materno">
            <input class="buttons" type="submit" name="" value="Registrar">
        </form>
        <h1 style="color:black; font-size: 15px; text-align: center; font-weight: lighter;">
            Al iniciar sesión estás aceptando las normas de nuestro servicio, así como políticas de seguridad.
        </h1>
        <hr>
        <p style="color:black; text-align: center;">¿Ya tienes cuenta? <a href="login.php" style="color: #0091FF; font-size: 17px;
           font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Inicia sesión</a></p>
    </section>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
        </div>
    </div>

    <script>
    // Esperar a que la página se cargue completamente
    document.addEventListener("DOMContentLoaded", function () {
        // Obtén el modal
        var modal = document.getElementById("myModal");

        // Obtén el elemento <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];

        // Función para mostrar el modal
        function showModal(message) {
            document.getElementById("modal-message").innerHTML = message;
            modal.style.display = "block";
        }

        // Función para ocultar el modal cuando se hace clic en el botón de cierre o fuera del modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Llamar a la función showModal() aquí después de que la página se haya cargado
        <?php
        if ($result2 === TRUE) {
            echo "showModal('El registro se hizo exitosamente.');";
        } else {
            echo "showModal('El registro no se pudo realizar.');" . $conn->error;
        }
        ?>
    });
</script>


</body> 
</html>
