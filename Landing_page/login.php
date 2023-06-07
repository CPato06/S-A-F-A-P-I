<!DOCTYPE html>
<html>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    
        <head>
            <title>Inicio de sesion</title>
        </head>
     
    <body>
        <?php
        include('conexion.php');
        ?>
    <iframe src="log.php"></iframe>
        <div>    
            <h1><a href="landing_page.php" class="titulo">ShieldVerify API</a></h1>
            <hr>
        </div>

            <form class="form-login" method="POST" action="log.php">
                <h2 style="color: black; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
                 Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >Iniciar sesion</h2>
                <input class="controls" type="email" name="email" value="" placeholder="Correo electronico" required>
                <input class="controls" type="password" name="password" id="contrasenia" placeholder="Contraseña" required>
                <a href="recu_pwd.php" style="font-size: 12px; font-weight: bold; color: #000055; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; float: right;" >Olvidaste tu Contraseña?</a>
                <input class="buttons" id="enviar" type="submit" name="enviar" value="Ingresar">
                <h1 style="color:black; font-size: 15px; text-align: center; font-weight: lighter;">
                    Al iniciar sesion estas aceptando las normas de nuestro servicio, asi como politicas de seguridad.
                </h1>
                <hr>
              <p style="color:black;">No estas registrado? <a href="registro.php" style="color: #0091FF; font-size: 17px; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Crea una cuenta</a></p>
    </form>
        <script src="code.js"></script>
    </body> 

</html>