<?php
  require_once('db.php');
  include_once "admin/db2.php";
  $con = mysqli_connect($host, $user, $pass, $db);
  $db = new DB();
  session_start();

  $id= $_SESSION['id'];
  $query="SELECT * from direcciones where usuario = '$id';";
  $res=mysqli_query($con,$query);
  $row=mysqli_fetch_assoc($res);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Funko Shop</title>
    <meta name="twitter:" content="">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="img/Decoracion/Logo.png" />
  </head>
  <body>
    <?php include_once "header.php"; ?>
        <main class="main">
            <div class="container" id="divContac">
              <a href="historial_compras.php" title="Regresar a mis compras"><svg style="width: 30px; margin: 5px; margin-left: 10px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"/></svg></a>
                <br><br>
                    <section>

                    <form class="formContac" action="editarDirec.php" method="POST" >
                        <fieldset>
                        <legend>Editar Direccion</legend>
                        <p>
                            <label class="lblConta">Calle y número: &nbsp;&nbsp; &nbsp;</label>
                            <input type="text" name="username" value="<?php echo $row['calle'] ?>" required="required">
                        </p>
                        <br>
                        <p>
                            <label class="lblConta">Código postal: &nbsp; &nbsp;&nbsp; </label>
                            <input type="number"  name="email" value="<?php echo $row['cpostal'] ?>" required="required">
                        </p>
                        <br>
                        <p>
                            <label class="lblConta">Referencias:&nbsp;</label>
                            <textarea name="referencias" style="margin-left: 20%"><?php echo $row['referencias'] ?></textarea>
                        </p>
                        <hr>
                        <br>
                        <p>
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
                            <button class="btnRegistroContac" name="register" style="margin-left: 10%">Editar</button>
                        </p>
                        </fieldset>
                    </form>
                    </section>
                <br><br>

            </div>
        </main>
    <?php include_once "footer.php"; ?>
  </body>
  <script src="js/slider.js"></script>
</html>