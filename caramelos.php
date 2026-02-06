<?php
session_start();
include 'CConexion.php';

$conn = CConexion::conexionBD();
$sql = "SELECT * FROM productos WHERE categoria = 'caramelos'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caramelos</title>
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
        <a href="#" id="menu-link">Menú</a>
        <a href="informacion.php">Información</a>
        <a href="contacto.php">Contacto</a>
    </nav>
    <section id="welcome-section">
        <div class="titulo">
            <h1>Caramelos surtidos</h1>
        </div>
        <section class="products-container">
            <?php foreach ($productos as $producto): ?>
                <div class="product-container">
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p>Precio: $<?php echo number_format($producto['precio_unidad'], 2); ?></p>
                    <button class="details-btn" onclick="location.href='detalles_producto.php?id=<?php echo $producto['id_producto']; ?>'">Más detalles</button>
                </div>
            <?php endforeach; ?>
        </section>
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
