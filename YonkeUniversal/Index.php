<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | Yonke Universal</title>
    
    <!--===============================================================================================-->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="img/imagesPage/engrane.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="css/estilosIndex.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!--===============================================================================================-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7108XZ5DRL"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-7108XZ5DRL');
    </script>
</head>

<body>

    <a href="https://api.whatsapp.com/send?phone=526462754273&text=Hola%21%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20la%20pieza%20de%20un%20auto." class="float" target="_blank">
        <i class="fab fa-whatsapp my-float"></i>
    </a>

    <div id="modalAuto">
        <!--Aqui estara el popUp con la informacion del auto-->
    </div>

<!-- MENU -->   
<div class="contenedorTotal">
   <header>
      <div class="contHeader">
        <div class="logo">
           <a class="navbar-brand" href="/"><img class="logoPrincipal" src="img/imagesPage/logoPerron.png" alt="..."></a>
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
   
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
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
          
          <li class="nav-item active">
            <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Autos.php">Autos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contactanos.php">Contacto</a>
          </li>
        </ul>
      </div>
    </nav>
    
    <!--SLIDER-->  
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/fondos/1.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>YONKE UNIVERSAL</h5>
            <p>SERVICIOS, AUTOPARTES &amp; MAS...</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/fondos/2.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>YONKE UNIVERSAL</h5>
            <p>SERVICIOS, AUTOPARTES &amp; MAS...</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/fondos/3.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>YONKE UNIVERSAL</h5>
            <p>SERVICIOS, AUTOPARTES &amp; MAS...</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- PUNTOS CENTRALES --> 
    <section class="services-section">
    <div class="inner-width">
        <h1>Nuestros <span class="textColor">Servicios</span></h1>
     <div class="services owl-carousel">

          <div class="service">
            <div class="service-icon">
              <i class="fas fa-box-open"></i>
            </div>
            <div class="service-name">Envios</div>
            <div class="service-desc">Servicio de envío por paquetería dentro de Baja California Norte y Baja California Sur.</div>
          </div>

          <div class="service">
            <div class="service-icon">
              <i class="fas fa-hammer"></i>
            </div>
            <div class="service-name">Refacciones</div>
            <div class="service-desc">Variedad en autopartes, pregunta por tus refacciones al 646 275 42 73, si no la tenemos la conseguimos.</div>
          </div>

          <div class="service">
            <div class="service-icon">
              <i class="fas fa-medal"></i>
            </div>
            <div class="service-name">Especialidad</div>
            <div class="service-desc">Nuestro equipo se especializa en el apartado de sistemas electronicos vehiculares.</div>
          </div>

          <div class="service">
            <div class="service-icon">
              <i class="far fa-user-circle"></i>
            </div>
            <div class="service-name">Cliente</div>
            <div class="service-desc">En nuestro negocio su satisfaccion con nuestras autopartes es nuestra prioridad.</div>
          </div>

          <div class="service">
            <div class="service-icon">
              <i class="fas fa-headset"></i>
            </div>
            <div class="service-name">Contacto</div>
            <div class="service-desc">Horario de Lun. a Sab. de 8:00am a 5:00pm. Tel.646 275 42 73</div>
          </div>
        </div>
      </div>
    </section>
     
    <!-- AUTOS RECIENTES -->  
    <div class="containerAll-Autos">
       <div class="tituloAutos">
           <h1>RECIEN LLEGADOS</h1>
       </div>
        
         <div class="seccionAutos">
               <?php 
                require_once("conexion.php");
             
                // Iniciamos sentencia preparada
                $stmt = $conexion->prepare("SELECT id, nombreauto, nombre  FROM tbautos INNER JOIN imagenes ON tbautos.id = imagenes.idAuto AND imagenes.numero=1 ORDER BY id DESC LIMIT 3");
                $stmt->execute();
                $resultado = $stmt->get_result();

                 if ($resultado->num_rows>0) {
                    // Obtenemos los valores
                    while ($fila = $resultado->fetch_assoc()) {
                            echo "<div class='card'>
                                    <img src='img/autos/".$fila['id']."/".$fila['nombre']."' alt=''>
                                    <h4>".$fila['nombreauto']."</h4>
                                    <p>¿Necesitas una pieza? Da click abajo.</p>
                                    <a href='javascript:void(0)' onclick='mostrarDetalles(".$fila['id'].")'>MAS DETALLES</a>
                                   </div>";
                    }
                 } else {
                     for($i=1; $i <= 3; $i++){
                         echo "<div class='card'>
                                    <img src='' alt=''>
                                    <h4>Proximamente</h4>
                                    <p>¿Necesitas una pieza? Mandanos Ws.</p>
                                    <a href='#'>Proximamente</a>
                                </div>";
                     }
                 } 
                // Cerramos la sentencia preparada
                $stmt->close();
                $conexion->close();
                ?>
                
		  </div>
		  <div class="textoBuscador">
            <div class="textoBusc">
              <h3>¿Buscas un auto?</h3>
            </div>
            <div class="botonBusc">
              <a href="Autos" class="button"><i class="fas fa-search"></i> Ver autos</a>
            </div>
		  </div>    
    </div>
    <!-- GALERIA AUTOS --> 
    <div class="GaleriaTitulo">
        <h1>Auto<span>partes</span></h1>
        <p>Las piezas mas pedidas por los clientes</p>
    </div>
    <div class="contenedorGaleria">
        <div class="box">
            <div class="imgBox">
                <img src="img/AutoPartes/amortiguadores.jpg" alt="AutoParte">
            </div>
            <div class="contenido">
                <div>
                    <h2>Amortiguadores</h2>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="imgBox">
                <img src="img/AutoPartes/CvJoint.png" alt="AutoParte">
            </div>
            <div class="contenido">
                <div>
                    <h2>Cv Joint</h2>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="imgBox">
                <img src="img/AutoPartes/horquilla.jpg" alt="AutoParte">
            </div>
            <div class="contenido">
                <div>
                    <h2>Horquillas</h2>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="imgBox">
                <img src="img/AutoPartes/PowerSteering.jpg" alt="AutoParte">
            </div>
            <div class="contenido">
                <div>
                    <h2>Motor eléctrico de dirección asistida</h2>
                </div>
            </div>
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
                    <li><i class="fas fa-phone-alt dir"></i>(646) 275-42-73</li>
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
   
    <!--==================================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" charset="utf-8"></script>
    <!--==================================================================================================-->
    <script>
        function mostrarDetalles(id){

            var ruta = 'popUpAuto.php?id=' + id;
            $.get(ruta, function (data) {
               $('#modalAuto').html(data);
               $('#modalQuickView').modal('show');
            });

        }

      $(".services").owlCarousel({
        margin:20,
        loop:true,
        autoplay:true,
        autoplayTimeout: 7000,
        autoplayHoverPause:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:2
          },
          1000:{
            items:3
          }
        }
      });
    </script>
    <!--==================================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
</body>
</html>