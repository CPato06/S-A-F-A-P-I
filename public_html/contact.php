<?php session_start(); ?>

<!DOCTYPE html>
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
            <br><br>
              <section>
                <form class="formContac" action="/crear_comentario.php" method="POST" >
                  <fieldset>
                    <legend>Tu opinion nos importa</legend>
                    <p>
                      <label class="lblConta">Nombre:</label>
                      <input type="text" placeholder="Nombre" name="username">
                    </p>
                    <p>
                      <label class="lblConta">Email:&nbsp;</label>
                      <input type="text" placeholder="Email" name="email">
                    </p>
                    <p>
                      <label class="lblConta">Comentarios:</label>
                    </p>
                    <p>
                      <textarea name="comentario"  id="labelContac" cols="30 " rows="5" placeholder="Comentarios..."></textarea>
                    </p>
                    <p>
                      <button class="btnEnviarContac" name="enviar">ENVIAR</button>
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
