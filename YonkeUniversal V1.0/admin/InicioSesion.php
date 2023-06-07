<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio de sesion | Yonke Universal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/logo2.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/css/estilosLogin.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/LogoYonkeDark.png" alt="IMG">
				</div>

				<form action="../admin/" method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						Inicio de sesion
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Se requiere el usuario">
						<input class="input100" type="text" name="usuario" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Se requiere la contraseña">
						<input class="input100" type="password" name="contrasena" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Iniciar sesion
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							¿Olvidaste tu
						</span>
						<a class="txt2" href="#" onclick = "contacto()">
							usuario y/ó contraseña?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<script>
        function contacto() {
            Swal.fire(
              'Contacte con el admin',
              'Para que le pueda restablecer su usuario y/ó contraseña',
              'info'
            )
        }
    </script>
<!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
<!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--==================================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<script src="assets/js/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/jsLogin.js"></script>

</body>
</html>