<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Dulcería "Sugar Kei"</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
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
        <a href="#" id="inicio-link">Inicio</a>
        <a href="#" id="menu-link">Menú</a>
        <a href="informacion.php">Información</a>
        <a href="contacto.php">Contacto</a>
    </nav>
    <section id="welcome-section">
        <h2>Bienvenidos a Dulcería "Sugar Kei"</h2>
        <div class="carousel">
            <div><img src="dulces.jpg" alt="Imagen 1"></div>
            <div><img src="dulceria.jpg" alt="Imagen 2"></div>
            <div><img src="imagen3.jpg" alt="Imagen 3"></div>
        </div>
        <p>¡Descubre los dulces más deliciosos y geniales! Ven y disfruta de una experiencia única con sabores inolvidables. Contamos con los dulces más exclusivos.</p>
        <div><img src="gato1.jpg" alt="Imagen 1"></div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</body>
</html>
