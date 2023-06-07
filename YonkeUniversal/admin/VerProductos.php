<?php

$usuario = $_SESSION['user'];

if(!isset($usuario)){
    header("location: ../admin/");
}

?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Administradores | Yonke Universal</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <link rel="icon" type="image/png" href="../img/icon/engrane.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="assets/css/estilosVer.css">
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Elementos autos</li><!-- /.menu-title -->
                <li class="active">
                    <a href="../admin/"><i class="menu-icon fas fa-car"></i>Autos </a>
                </li>
                <li class="menu-item">
                    <a href="../admin/CrearProductos"><i class="menu-icon fas fa-plus"></i>Añadir autos </a>
                </li>
                <li class="menu-title">Pagina principal</li><!-- /.menu-title -->
                <li class="menu-item">
                    <a href="/"><i class="menu-icon fas fa-home"></i>Inicio </a>
                </li>
                <li class="menu-item">
                    <a href="../Autos"><i class="menu-icon fas fa-search"></i>Buscador </a>
                </li>
                <li class="menu-item">
                    <a href="../Contactanos"><i class="menu-icon fas fa-phone-alt"></i>Contactanos </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="/"><img src="images/logo.png" alt="Logo" width="80"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="cerrarSesion.php"><i class="fas fa-power-off"></i>Cerrar sesion</a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Orders -->
            <div class="orders">
               <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <form>
                          <div class="form-box card-body">
                              <label class="sr-only" for="inlineFormInput">Auto</label>
                              <input type="text" class="campo-busqueda auto" id="auto" placeholder="Buscar auto">
                              <button type="submit" class="btn-buscar"><i class="fas fa-search"></i></button>
                          </div>
                        </form>
                    </div>
                </div>
               </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Autos disponibles </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="serial">#</th>
                                                <th class="avatar">Auto</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Año</th>
                                                <th>Descripcion</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="autos"></tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div>  <!-- /.col-lg-8 -->
                </div>
            </div>
            <!-- /.orders -->
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2020 Yonke Universal
                </div>
                <div class="col-sm-6 text-right">
                    Desarrollado por <a href="#">YK</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/funcionesAjax.js"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <!--===============================================================================================-->

</body>
</html>
