<?php
class DB {

  public $server = "localhost";
  public $user = "id19072847_root";
  public $passwd = "60(~kf#!cO\FtE}G";
  public $db = 'id19072847_funko_shop';
  public $connection;

  function __construct(){
    $this->connection = mysqli_connect($this->server, $this->user, $this->passwd, $this->db);
  }

  function __destruct(){
    mysqli_close($this->connection);
  }

  function restorePass(){
    $results = mysqli_query($this->connection, "SET PASSWORD FOR root@localhost = PASSWORD('');");
  }

  function getProductosNuevos(){
    $sql = "SELECT * FROM `productos` WHERE tipo = 'nuevo';";
    $results = mysqli_query($this->connection, $sql);

    $productosArray = array();
    while($row = mysqli_fetch_assoc($results)){
        $productosArray[] = $row;
    }

    return $productosArray;
  }

  function getProductos(){
      $sql = "SELECT * FROM `productos` WHERE existencia > 0;";
      $results = mysqli_query($this->connection, $sql);

      $productosArray = array();
      while($row = mysqli_fetch_assoc($results)){
          $productosArray[] = $row;
      }

      return $productosArray;
  }

  function getProductosMarca($marca){
    $sql = "SELECT * FROM `productos` WHERE marca = '$marca' AND existencia > 0;";
    $results = mysqli_query($this->connection, $sql);

    $productosArray = array();
    while($row = mysqli_fetch_assoc($results)){
        $productosArray[] = $row;
    }

    return $productosArray;
  }

  function agregarComentario($nombre, $email, $comentario){
    $sql = "INSERT INTO contactanos(nombre, correo, comentario) VALUES ('$nombre', '$email', '$comentario');";
    $results = mysqli_query($this->connection, $sql);
  }

  function emailExiste($email) {
    $sql = "Select * from usuarios where correo='$email'";
    $results = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($results);
        if ($num == 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
  }
  
  function emailVacio($email) {
    $sql = "UPDATE usuarios SET correo = '' WHERE correo = '$email';";
    $results = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($results);
        if ($num == 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
  }

  function crearUsuario($nombre, $email, $contrasena) {
    $sql = "INSERT INTO usuarios(nombre, correo, contrasena) VALUES ('$nombre', '$email', '$contrasena');";
    $results = mysqli_query($this->connection, $sql);
    $id = mysqli_insert_id($this->connection);
    return $id;
  }
  
  function actualizarUsuario($id, $nombre, $email, $contrasena) {
    $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$email', contrasena = '$contrasena' WHERE id = '$id';";
    $results = mysqli_query($this->connection, $sql);
  }

  function ingresarAdmin($email, $password) {
    $sql = "SELECT * from administradores where correo='$email'";
    $results = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($results);

    if ($num > 0) {
      $sql = "SELECT * from administradores where correo='$email' and contrasena='$password'";
      $results = mysqli_query($this->connection, $sql);
      $num = mysqli_num_rows($results);

      if ($num > 0){
        $result = true;
      }
      else{
        echo'<script type="text/javascript">
        alert("La contraseña ingresada es incorrecta");
        window.location.href="index.php";
        </script>';
      }


    } else {
      echo'<script type="text/javascript">
        alert("El correo ingresado no existe");
        window.location.href="index.php";
        </script>';
    }

    return $result;
  }
  
  function eliminarUsuario($identificador) {
  $queryEliminar = "UPDATE usuarios SET correo = '' WHERE id = '$identificador';";
  $resEliminar=mysqli_query($this->connection,$queryEliminar);
}

function registrarDireccion($calle, $codigo, $referencia, $id){
  $sql = "INSERT INTO direcciones(calle, cpostal, referencias, usuario) VALUES ('$calle', '$codigo', '$referencia', '$id');";
  $results = mysqli_query($this->connection, $sql);
}

function editarDireccion($calle, $codigo, $referencia, $id){
  $sql = "UPDATE direcciones SET calle = '$calle', cpostal = '$codigo', referencias = '$referencia' WHERE usuario = '$id';";
  $results = mysqli_query($this->connection, $sql);
}

  function obtenerIdAdmin($email, $password) {
    $sql = "SELECT * FROM  administradores where correo='$email' AND contrasena = '$password';";
    $results = mysqli_query($this->connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $idEx = $row['ID_admin'];
    return $idEx;
  }

  function obtenerNombreAdmin($email, $password) {
    $sql = "SELECT * FROM  administradores where correo='$email' AND contrasena = '$password';";
    $results = mysqli_query($this->connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $adminNom = $row['nombre'];
    return $adminNom;
  }

  function ingresarUsuario($email, $password) {
    $sql = "Select * from usuarios where correo='$email'";
    $results = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($results);

    if ($num > 0) {
      $sql = "SELECT * from usuarios where correo='$email' and contrasena='$password'";
      $results = mysqli_query($this->connection, $sql);
      $num = mysqli_num_rows($results);

      if ($num > 0){
        $result = true;
      }
      else{
        echo'<script type="text/javascript">
        alert("La contraseña ingresada es incorrecta");
        window.location.href="iniciar_sesion.php";
        </script>';
      }


    } else {
      echo'<script type="text/javascript">
        alert("El correo ingresado no existe");
        window.location.href="iniciar_sesion.php";
        </script>';
    }

    return $result;
}

function obtenerID($email, $password) {
  $sql = "SELECT * FROM  usuarios where correo='$email' AND contrasena = '$password';";
  $results = mysqli_query($this->connection, $sql);
  $row = mysqli_fetch_assoc($results);
  $idEx = $row['id'];
  return $idEx;
}

function obtenerCantidad($carritoId, $productoId){
  $sql = "SELECT * FROM carrito_productos where carrito_id='$carritoId' AND producto_id='$productoId';";
  $results = mysqli_query($this->connection, $sql);
  $row = mysqli_fetch_assoc($results);
  $idEx = $row['cantidad'];
  return $idEx;
}

  function agregarProductoCarrito($carrito_id, $producto_id, $quantity) {
    $sql = "SELECT * FROM carrito_productos WHERE carrito_id =$carrito_id AND producto_id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($results);
    $row = mysqli_fetch_assoc($results);
    if ($num > 0){
      $nQuantity = $row['cantidad'] + $quantity;
      $sql = "UPDATE carrito_productos SET cantidad = $nQuantity WHERE carrito_id = $carrito_id AND producto_id = $producto_id;";
      $results = mysqli_query($this->connection, $sql);
    }
    else{
      $sql = "INSERT INTO carrito_productos(carrito_id, producto_id, cantidad) VALUES ($carrito_id, $producto_id, $quantity);";
      $results = mysqli_query($this->connection, $sql);
    }
  }

  function botonMasBD($carrito_id, $producto_id, $quantity) {
    $sql = "SELECT * FROM carrito_productos WHERE carrito_id =$carrito_id AND producto_id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $nQuantity = $row['cantidad'] + $quantity;
    $sql = "UPDATE carrito_productos SET cantidad = $nQuantity WHERE carrito_id = $carrito_id AND producto_id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
  }

  function botonMenosDB($carrito_id, $producto_id, $quantity) {
    $sql = "SELECT * FROM carrito_productos WHERE carrito_id =$carrito_id AND producto_id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $nQuantity = $row['cantidad'] - $quantity;
    $sql = "UPDATE carrito_productos SET cantidad = $nQuantity WHERE carrito_id = $carrito_id AND producto_id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
  }

  function eliminarProductoCarrito($carrito_id, $producto_id) {
    $sql = "DELETE FROM carrito_productos WHERE carrito_id = $carrito_id AND producto_id = $producto_id LIMIT 1;";
    $results = mysqli_query($this->connection, $sql);
  }

  function actualizarExistenica($producto_id, $quantity) {
    $sql = "UPDATE productos SET existencia = $quantity WHERE id = $producto_id;";
    $results = mysqli_query($this->connection, $sql);
  }

  function pagarCarrito($carrito_id) {
    $sql = "UPDATE carrito SET finalizado = 1 WHERE id = $carrito_id;";
    $results = mysqli_query($this->connection, $sql);
  }

  function getCarrito($usuario_id) {
    $sql = "SELECT * FROM carrito WHERE usuario_id = $usuario_id AND finalizado = 0;";
    $results = mysqli_query($this->connection, $sql);
    if(mysqli_num_rows($results) == 0):
      $sql_create = "INSERT INTO carrito(usuario_id) VALUES ('$usuario_id');";
      $result_create = mysqli_query($this->connection, $sql_create);
      $id = mysqli_insert_id($this->connection);
    else:
      $row = mysqli_fetch_assoc($results);
      $id = $row['id'];
    endif;

    return $id;
  }

  function getProductosCarrito($carrito_id) {
    $sql = "SELECT * FROM carrito_productos WHERE carrito_id = $carrito_id;";
    $results = mysqli_query($this->connection, $sql);
    $productosArray = array();
    while($row = mysqli_fetch_assoc($results)){
      $id_p = $row['producto_id'];
      $sql_p = "SELECT * FROM productos WHERE id = $id_p";
      $result_p = mysqli_query($this->connection, $sql_p);
      $row_p = mysqli_fetch_assoc($result_p);
      $productosArray[] = $row_p;
    }

    return $productosArray;
  }
}

function getProductosComprados($venta_id) {
  $sql = "SELECT * FROM carrito_productos WHERE carrito_id = $venta_id;";
  $results = mysqli_query($this->connection, $sql);
  $productosArray = array();
  while($row = mysqli_fetch_assoc($results)){
    $id_p = $row['producto_id'];
    $sql_p = "SELECT * FROM productos WHERE id = $id_p";
    $result_p = mysqli_query($this->connection, $sql_p);
    $row_p = mysqli_fetch_assoc($result_p);
    $productosArray[] = $row_p;
  }

  return $productosArray;
}
?>
