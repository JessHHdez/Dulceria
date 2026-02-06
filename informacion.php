<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información - Dulcería "Sugar Kei"</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <header>
        <div class="home-title-container">
            <div class="corner-gif top-left"></div>
            <h1>Dulcería "Sugar Kei"</h1>
            <div class="corner-gif top-right"></div>
        </div>
    </header>

    <div class="auth-buttons">
    <a href="carrito.php" class="cart-button">Carrito</a>
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
        <a href="cerrar_sesion.php" class="auth-button">Cerrar sesión</a>
        <?php if ($_SESSION['es_admin']): ?>
            <a href="admin.php" class="auth-button">Administración</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="registro.php" class="auth-button">Registro</a>
        <a href="iniciar_sesion.php" class="auth-button">Iniciar sesión</a>
    <?php endif; ?>
</div>

    <nav>
        <a href="index.php" id="inicio-link">Inicio</a>
        <a href="menu.php" id="menu-link">Menú</a>
        <a href="#" id="informacion-link">Información</a>
        <a href="contacto.php">Contacto</a>
    </nav>
    <section id="welcome-section">
          <h2>Información</h2>
          <img src="dulces.jpg" alt="Dulcería" class="main-image">
          <p>En Dulcería "Sugar Kei", nos especializamos en crear dulces artesanales con ingredientes de la más alta calidad. Nuestra misión es ofrecer productos que no solo sean deliciosos, sino que también brinden una experiencia única y memorable.</p>
          <p>Nos encontramos en el corazón de la ciudad y estamos abiertos todos los días de la semana para endulzar tu día.</p>
          <h3>Proceso Artesanal</h3>
          <p>Cada dulce que sale de nuestra cocina es el resultado de un proceso meticuloso y artesanal. Comenzando con la selección de los mejores ingredientes, pasando por la creación de recetas exclusivas y culminando en una cuidadosa producción, garantizamos que cada bocado sea una experiencia inolvidable.</p>
          <h3>Variedad Exquisita</h3>
          <p>En Dulcería "Sugar Kei" encontrarás una amplia variedad de productos que deleitarán tu paladar. Desde caramelos suaves y chocolates gourmet hasta galletas artesanales y confites creativos, nuestra tienda está repleta de sabores irresistibles para todos los gustos. Descubre nuestras creaciones únicas y déjate sorprender por la calidad y el sabor inigualable.</p>
          <h3>Compromiso con la Calidad</h3>
          <p>Nos enorgullecemos de ofrecer dulces de la más alta calidad, elaborados con ingredientes frescos y naturales. Nuestro compromiso es brindar a nuestros clientes no solo productos deliciosos, sino también una experiencia que despierte los sentidos y genere momentos de felicidad y satisfacción.</p>
          <h3>Valores que nos Definen</h3>
          <p>En Dulcería "Sugar Kei" valoramos la pasión por los dulces, la creatividad en la cocina y la satisfacción de nuestros clientes. Nos esforzamos por mantener altos estándares de calidad, responsabilidad social y respeto por el medio ambiente en cada aspecto de nuestro negocio.</p>
          <h3>Testimonios de Clientes</h3>
          <p>Nuestros clientes son nuestra mejor carta de presentación. Descubre lo que dicen quienes han probado nuestros dulces:</p>
          <ul>
              <li>"Los caramelos de Sugar Kei son adictivamente deliciosos. ¡No puedo resistirme a volver por más!" - María Gómez</li>
              <li>"¡Los chocolates gourmet son un verdadero placer para el paladar! Una experiencia de sabor única." - Javier Martínez</li>
              <li>"Gracias a Dulcería Sugar Kei, pude sorprender a mis invitados con los mejores dulces artesanales en mi evento. ¡Recomendado al 100%!" - Ana Rodríguez</li>
          </ul>
      </section>
    <section id="menu" class="dropdown-content">
        <h2>Menú</h2>
        <ul>
            <li><a href="caramelos.php" id="link">Caramelos surtidos</a></li>
            <li><a href="chocolates.php" id="link">Chocolates gourmet</a></li>
            <li><a href="galletas.php" id="link">Galletas artesanales</a></li>
            <li><a href="gomitas.php" id="link">Confites y gomitas</a></li>
            <li><a href="mazapanes.php" id="link">Turrones y mazapanes</a></li>
        </ul>
    </section>
    <footer id="main-footer">
      <p>&copy; 2024 Dulcería "Sugar Kei". Todos los derechos reservados.</p>
    </footer>
    <script>
          setTimeout(function() {
              document.getElementById('main-footer').style.display = 'none';
          }, 1000);
    </script>
</body>
</html>
