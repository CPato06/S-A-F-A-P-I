<?php

    require_once '../conexion.php';
    require_once 'funciones.php';

    session_start();
    $usuario = $_SESSION['user'];

    if(!isset($usuario)){
        header("location: admin/");
    }

    if(isset($_GET['edit_id']) && !empty($_GET['edit_id'])){

    $id = $_GET['edit_id'];

    $stmt_edit = $conexion->prepare("SELECT * FROM tbautos WHERE id = ?");
    $stmt_edit->bind_Param('i', $id);
    $stmt_edit->execute();    
    $resultado = $stmt_edit->get_result();
    $edit_row = $resultado->fetch_assoc();

    $stmt_img = $conexion->prepare("SELECT nombre, numero FROM imagenes WHERE idAuto = ?");
    $stmt_img->bind_Param('i', $id);
    $stmt_img->execute();    
    $grupoImg = $stmt_img->get_result();

        while($img_row = $grupoImg->fetch_assoc()){
            $nombres[] = $img_row['nombre'];
            $numeros[] = $img_row['numero'];
        }
    }

    @$foto1 = verificar(1,$numeros,$nombres,$id);
    @$foto2 = verificar(2,$numeros,$nombres,$id);
    @$foto3 = verificar(3,$numeros,$nombres,$id);
    @$foto4 = verificar(4,$numeros,$nombres,$id);
    @$foto5 = verificar(5,$numeros,$nombres,$id);
    @$foto6 = verificar(6,$numeros,$nombres,$id);

?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Añadir auto | Yonke Universal</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <link rel="icon" type="image/png" href="../img/icon/engrane.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="assets/css/estilosSubir.css">
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
                <li class="menu-item">
                    <a href="../admin/"><i class="menu-icon fas fa-car"></i>Autos </a>
                </li>
                <li class="active">
                    <a href="admin/CrearProductos"><i class="menu-icon fas fa-plus"></i>Añadir autos</a>
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
                    <div class="card-title">
                        <h4 class="box-title">Añadir autos </h4>
                    </div>
                    <div class="card-body">
                            <form method="post" enctype="multipart/form-data" id="frmAjax">
                              <input type="hidden" name="usuario" value="<?php echo @$usuario; ?>">
                              <input type="hidden" name="id_registro" value="<?php echo @$edit_row['id']; ?>">

                              <div class="form-row">  
                                <div class="form-group col-md-3">
                                  <input type="text" value="<?php echo @$edit_row['nombreauto']; ?>" class="campo-subir nomCom" name="nombreauto" id="inputNombre" placeholder="Nombre completo del vehiculo" readonly>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-3">
                                  <input type="text" value="<?php echo @$edit_row['marca']; ?>" class="campo-subir width" name="marca" id="inputMarca" placeholder="Marca" onkeyup="enviarTexto()" required>
                                </div>
                                <div class="form-group col-md-3">
                                  <input type="text" value="<?php echo @$edit_row['modelo']; ?>" class="campo-subir width" name="modelo" id="inputModelo" placeholder="Modelo" onkeyup="enviarTexto()" required>
                                </div>
                                <div class="form-group col-md-3">
                                  <input type="number" value="<?php echo @$edit_row['anio']; ?>" class="campo-subir anio" name="anio" id="inputAnio" placeholder="Año" onkeyup="enviarTexto()" required>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-2">
                                  <input type="text" value="<?php echo @$edit_row['estado']; ?>" class="campo-subir width" name="estado" id="inputEstado" placeholder="Estado" required>
                                </div>
                                <div class="form-group col-md-2">
                                  <input type="text" value="<?php echo @$edit_row['cilindros']; ?>" class="campo-subir width" name="cilindros" id="inputCilin" placeholder="Cilindros" required>
                                </div>
                                <div class="form-group col-md-2">
                                  <input type="text" value="<?php echo @$edit_row['Motor']; ?>" class="campo-subir width" name="Motor" id="inputMotor" placeholder="Motor" required>
                                </div>
                                <div class="form-group col-md-2">
                                  <input type="text" value="<?php echo @$edit_row['transmision']; ?>" class="campo-subir width" name="transmision" id="inputTrans" placeholder="Transmision" required>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_1" id="file-1" class="inputfile inputfile-2" accept="image/*" required/>
                                    <label for="file-1"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="<?= $foto1 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[0])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa principal</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_2" id="file-2" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-2"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                         <img src="<?= $foto2 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[1])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa secundaria</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_3" id="file-3" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-3"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="<?= $foto3 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[2])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa secundaria</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_4" id="file-4" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-4"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="<?= $foto4 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[3])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa secundaria</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_5" id="file-5" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-5"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="<?= $foto5 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[4])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa secundaria</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group contenedor_inputFile col-md-4">
                                    <input type="file" name="foto_6" id="file-6" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-6"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="<?= $foto6 ?>" alt="" class="image-preview__img">
                                        <?php if(empty($numeros[5])){ ?>
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa secundaria</span>
                                        <?php } ?>
                                    </div>
                                </div>
                              </div>
                              
                              <?php if(isset($_GET['edit_id'])) { ?>
                                  <input type="hidden" name="update" id="Actualizar">
                                  <input type="submit" value="Actualizar" id="btnActuaz" class="btn btn-primary">
                              <?php } else {?>
                                  <input type="hidden" name="submit" id="Guardar">
                                  <input type="submit" id="btnGuardar" class="btn btn-dark">
                              <?php } ?>
                            </form>
                            
                            <div class="form-group" id="process">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
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
                    Diseñada por <a href="#">YK</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

    <!-- Scripts -->
    <script>
        function enviarTexto() {
            var marca = document.getElementById("inputMarca").value;
            var modelo = document.getElementById("inputModelo").value;
            var anio = document.getElementById("inputAnio").value;

            document.getElementById("inputNombre").value = marca + " " + modelo + " " + anio;
        }
        
    </script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/customFile.js"></script>
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
