<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autos | Yonke Universal</title>
    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="img/imagesPage/engrane.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="css/estilosBuscador.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--===============================================================================================-->
</head>

<body>
    <a href="https://api.whatsapp.com/send?phone=526462754273&text=Hola%21%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20la%20pieza%20de%20un%20auto." class="float" target="_blank">
        <i class="fab fa-whatsapp my-float"></i>
    </a>
    <div id="modalAuto">
        <!--Aqui estara el popUp con la informacion del auto-->
    </div>

<div class="contenedorTotal">
<!-- MENU -->
    <header class="header">
      <div class="contHeader">
        <div class="logo">
           <a class="navbar-brand" href="/"><img class="logoPrincipal" src="img/imagesPage/logoPerron.png"></a>
        </div>
        <div class="informacion">
           <div class="columnaDir">
               <i class="fas fa-map-marker-alt"></i>
               <p>Av. Moctezuma 991 Zona Centro 22800 Ensenada B.C.</p>
           </div>
           <div class="columnaHorario">
                <i class="far fa-clock"></i>
                <p>Lun - Sab 8:00 AM - 5:00 PM <br>
                    Domingo CERRADO</p>
           </div>
           <div class="columnaTel">
                <i class="fas fa-phone-alt"></i>
                <p><span>Tel:</span>646 275 42 73</p>
           </div>
        </div>
       </div>
   </header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark ">
      <a class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <?php if(isset($_SESSION['user'])){ ?>
          
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../admin/">Ver autos</a>
              <a class="dropdown-item" href="../admin/CrearProductos">Añadir auto</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../admin/cerrarSesion"><i class="fas fa-power-off"></i>  Cerrar sesion</a>
            </div>
          </li>
          <?php } ?>
          
          <li class="nav-item">
            <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="Autos">Autos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contactanos">Contacto</a>
          </li>
        </ul>
      </div>
    </nav>

<!-- SLIDER -->   
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/fondos/4.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>AUTOMOVILES</h5>
            <p>AQUI ENCONTRARAS EL AUTO QUE NECESITAS </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/fondos/5.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>AUTOMOVILES</h5>
            <p>AQUI ENCONTRARAS EL AUTO QUE NECESITAS </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/fondos/6.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>AUTOMOVILES</h5>
            <p>AQUI ENCONTRARAS EL AUTO QUE NECESITAS </p>
          </div>
        </div>
      </div>
    </div>

<!-- BUSCADOR -->
   <div class="contenedorBuscador" id="Buscador">
      <div class="form-box">
          <input class="campo-busqueda auto" name="auto" id="auto" type="text" placeholder="¿Que auto estas buscando?">
          <button class="btn-buscar" type="button"><i class="fas fa-search"></i></button>
      </div>
          <p class="form-box"><strong>Dato: Si requieres una pieza en especifico mandanos mensaje por WhatsApp.</strong></p>
      
       <div class="seccionAutos" id="seccionAutos">
           <!--====Aqui se mostraran los autos====-->
       </div>
   </div>
   
<!-- FOOTER -->
    <footer>
        <div class="inner-footer">

            <div class="footer-items phone">
                <h2><img class="bannerImg" src="img/imagesPage/logoPerron.png" width="70%"></h2>
                <div class="borde"></div>
                <p>
                    Nosotros nos dedicamos a la venta de autopartes usadas y nuevas, si no encuentra la parte que necesita nosostros se la conseguimos.
                </p>
            </div>

            <div class="footer-items phone">
                <h2>Links rapidos</h2>
                <div class="borde"></div>
                <ul>
                    <a href="/"><li><i class="fas fa-angle-right"></i>Inicio</li></a>
                    <a href="Autos"><li><i class="fas fa-angle-right"></i>Autos</li></a>
                    <a href="Contactanos"><li><i class="fas fa-angle-right"></i>Contacto</li></a>
                    
                    <?php if(isset($_SESSION['user'])){ ?>
                        <a href="../admin/"><li><i class="fas fa-angle-right"></i>Lista autos</li></a>
                        <a href="../admin/CrearProductos"><li><i class="fas fa-angle-right"></i>Añadir autos</li></a>
                    <?php } ?>
                </ul>
            </div>

            <div class="footer-items">
                <h2>Contactanos</h2>
                <div class="borde"></div>
                <ul>
                    <li>
                        <i class="fas fa-map-marker-alt dir"></i>
                        Av Moctezuma 991,Zona Centro 
                        22800 Ensenada B.C.
                    </li>
                    <li><i class="fas fa-phone-alt dir"></i>(646)275-42-73</li>
                    <li><i class="far fa-envelope dir"></i>shop.21974@gmail.com</li>
                </ul>
                <div class="social-media">
                    <a href=""><i class="fab fa-facebook-square Face"></i></a>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
           <div class="copyright">
               © 2020 Todos los Derechos Reservados
           </div>
        </div>
    </footer> 
</div>
    <div class="buttonUp-contenedor" id="button-up">
        <i class="fas fa-chevron-up"></i>
    </div>
    
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
   <!--==================================================================================================-->
   <script>
        function mostrarDetalles(id){

            var ruta = 'popUpAuto.php?id=' + id;
            $.get(ruta, function (data) {
               $('#modalAuto').html(data);
               $('#modalQuickView').modal('show');
            });

        }
    </script>
	<script src="js/arriba.js"></script>
	<!--==================================================================================================-->
    <script src="js/jsBuscador.js"></script>
    <!--==================================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
</body>
</html>