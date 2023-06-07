<header class="main-header">
          <div class="container container--flex">
            <div class="main-header__container">
              <h1 class="main-header__title">Comics Funko Shop</h1>
              <span class="icon-menu" id="btn-menu"><i class="fas fa-bars"></i></span>
              <nav class="main-nav" id="main-nav">
                <ul class="menu">
                  <li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
                  <li class="menu__item"><a href="productos.php" class="menu__link">Productos</a></li>
                  <li class="menu__item"><a href="contact.php" class="menu__link">Contáctanos</a></li>
                </ul>
              </nav>
            </div>
            <div class="main-header__container">
              <p class="main-header__txt">Envíos gratis a partir de $999</p>
            </div>
            <div class="main-header__container">
              <?php
              if(isset($_SESSION['email'])):?>
                <a href="carrito.php" class="main-header__btn">Carrito <i class="fas fa-shopping-cart"></i></a>
                <a href="historial_compras.php" class="main-header__link"><i class="fas fa-user"></i></a>
                <a href="cerrar_sesion.php"  class="main-header__link"><i class="fas fa-sign-out-alt"></i></a>
              <?php else:?>
                <a href="iniciar_sesion.php" class="main-header__link"><i class="fas fa-user"></i></a>
              <?php endif;?>
            </div>
          </div>
        </header>
