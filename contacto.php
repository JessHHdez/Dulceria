<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Dulcería "Sugar Kei"</title>
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
        <a href="informacion.php">Información</a>
        <a href="#" id="contacto-link">Contacto</a>
    </nav>
    <section id="welcome-section">
      <h2>Contacto</h2>
      <p>¿Quieres saber más sobre nosotros o hacer un pedido especial? </p>
      <p>¡Contáctanos!</p>
      <p>Dirección: Calle ESCOM, 123, Ciudad Web</p>
      <p>Teléfono: 55 63</p>
      <p>Email: dulceriaSugarKei@gmail.com</p>
      <p>Redes Sociales: []</p>
      <p>¡Ven a Dulcería "Sugar Kei" y descubre un mundo de dulzura y calidad incomparables!</p>
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
        // Espera 5 segundos (5000 milisegundos) y luego oculta el footer
        setTimeout(function() {
            document.getElementById('main-footer').style.display = 'none';
        }, 1000);
    </script>
</body>
</html>
