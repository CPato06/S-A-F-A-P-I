<!DOCTYPE html>
<html>
 <head>
   <title> Healthy Fit </title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="stylesheet" href="css/estilos.css">
   <meta charset="UTF-8">

   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
    <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>

 </head>
  <body>
  <div class="titulo"> 

    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Healthy Fit</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recetas.php">Recetas</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inicio de sesion
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Iniciar sesion</a></li>
            <li><a class="dropdown-item" href="registro.php">Registrarse</a></li>
          </ul>


          <li class="nav-item">
          <a class="nav-link" href="#">Bienvenido(a): 
            <?php echo $_SESSION['nombre']; ?></a>
            <li><a class="nav-link"href="logout.php">Cerrar Sesion</a></li>
        </li>
          <li class="nav-item">
          </a> 
        </li>
        </li>
      </ul>
      </form>
    </div>
  </div>
</nav>
    

    </div>
  </body>
</html>


<!DOCTYPE html>
<html>
 <head>
   <title> Healthy Fit </title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="stylesheet" href="css/estilos.css">
   <meta charset="UTF-8">

   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/es.css" rel="stylesheet" />
    <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>


 </head>
  <body>
  <div class="titulo"> <h1> Receta </h1> 

  
          <div >
            <img src=" imagenes/<?php echo $receta->imagen ;?>" width="530" height="320">

              <h1><?php echo $receta->Nombre?></h1>
              <h2 align="left">Especificaciones</h2>
              <p align="left"><?php echo $receta->Calorías?> Calorias</p>
              <p align="left"><?php echo $receta->Proteínas?> Proteinas</p>
              <p align="left"><?php echo $receta->Carbohidratos?> Carbohidratos</p>
              
              <h2 align="left">Preparacion</h2>
              <p align="left"><?php echo $receta->Preparacion?> </p>
              <h2 align="left">Ingredientes</h2>
              <p align="left"><?php echo $receta->Ingredientes?> </p>
              
              
           </div>  
    </head>
    
        <!-- Comentario section-->
        <form method="POST" action="enviarcomentario.php">
            <section id="contact">
                <div class="container px-4">
                    <div class="row gx-4 justify-content-center">
                        <div class="col-lg-8">
                            <h2>Comentarios</h2>
                
                                <div class="col-xs-12">
                                    <h3>¡Haz un Comentario!</h3>

                                    <br>
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input class="form-control" name="nombre" type="text" id="nombre" placeholder="Escribe tu nombre" required >
                                    </div>
                            
                                    
                            <br>
                                    <div class="form-group">
                                    <label for="comentario" class="form-label">Comentario:</label>
                                    <textarea class="form-control" name="comentario" cols="30" rows="5" type="text" id="comentario" 
                                    placeholder="Escribe tu comentario......"></textarea>
                                    </div>
                            <br>
                            <input class="btn btn-primary" type="submit"  value="Enviar Comentario">
                            <br>
                            <br>
                            <br>
                                    <?php

$conexion=mysqli_connect("localhost:3308","root","","proyecto_final"); 
$resultado= mysqli_query($conexion, 'SELECT * FROM comentarios');

while($comentario = mysqli_fetch_object($resultado)){

    ?>

    <b><?php echo($comentario->nombre);  ?></b>(<?php echo ($comentario->fecha); ?>) comento: 
    <br />
    <?php echo ($comentario->comentario);?>
    <br />
    <hr />




    <?php
}?>
    
    </div>
  </body>
</html>