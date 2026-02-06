<?php
session_start();
include 'CConexion.php';

$product_id = $_GET['id'];
$conn = CConexion::conexionBD();
$query = "SELECT * FROM productos WHERE id_producto = :product_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = intval($_POST['quantity']);
    $_SESSION['cart'][$product_id] = [
        'name' => $product['nombre'],
        'price' => $product['precio_unidad'],
        'quantity' => $quantity
    ];
    header("Location: carrito.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nombre']); ?></title>
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
            <h1><?php echo htmlspecialchars($product['nombre']); ?></h1>
        </div>
        <section id="details-section">
            <div class="product-details">
                <img src="<?php echo htmlspecialchars($product['imagen']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>">
                <div class="details-content">
                    <h2><?php echo htmlspecialchars($product['nombre']); ?></h2>
                    <p class="price">Precio: $<?php echo number_format($product['precio_unidad'], 2); ?></p>
                    <p class="description"><?php echo htmlspecialchars($product['descripcion']); ?></p>
                    <ul class="specifications">
                        <!-- Aquí puedes agregar más especificaciones si lo deseas -->
                    </ul>
                    <p>Cantidad disponible: <?php echo htmlspecialchars($product['cantidad_disponible']); ?> kg</p>
                    <form method="POST" action="">
                        <div class="quantity-selector">
                            <label for="quantity">Cantidad (kg):</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="<?php echo htmlspecialchars($product['cantidad_disponible']); ?>" value="1">
                        </div>
                        <button type="submit" class="purchase-btn">Comprar ahora</button>
                    </form>
                </div>
            </div>
        </section>
        <button class="back-btn" onclick="goBack()">Regresar</button>
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

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
