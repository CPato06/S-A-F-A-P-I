<!DOCTYPE html>
<html>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    
        <head>
            <title>Registro</title>
        </head>
     
    <body>
        <div>    
            <h1><a href="landing_page.php" class="titulo">ShieldVerify API</a></h1>
            <hr>
        </div>
        <?php
        include('conexion.php');
        ?>

            <section class="form-registro">
                <h2 style="color: black; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
                 Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >Registrate gratis</h2>
                <input class="controls" type="text" name="correo_empresa" value="" placeholder="Correo electronico de la empresa">
                <input class="controls" type="password" name="contrasena" value="" placeholder="Contraseña">
                <input class="controls" type="text" name="nombre_empresa" value="" placeholder="Nombre de la empresa">
                <input class="controls" type="text" name="nombre_usu" value="" placeholder="Nombre">
                <input class="controls" type="text" name="ap_paterno" value="" placeholder="Apellido paterno">
                <input class="controls" type="text" name="ap_materno" value="" placeholder="Apellido materno">
                <input class="buttons" type="submit" name="" value="Ingresar">
                <h1 style="color:black; font-size: 15px; text-align: center; font-weight: lighter;">
                    Al iniciar sesion estas aceptando las normas de nuestro servicio, asi como politicas de seguridad.
                </h1>
                <hr>
              <p style="color:black; text-align: center;">ya tienes cuenta? <a href="login.php" style="color: #0091FF; font-size: 17px;
               font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Inicia sesion</a></p>
            </section>
        
    </body> 

</html>