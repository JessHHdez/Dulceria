<?php
session_start();
include 'CConexion.php'; // Incluye tu archivo de conexión a la base de datos

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Procesar la acción de quitar del carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: carrito.php"); // Redirigir para actualizar la página
    exit;
}

// Procesar la acción de pagar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    try {
        $conn = CConexion::conexionBD();

        // Procesar cada artículo en el carrito
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $quantity = $product['quantity'];
            $price_total = $product['price'] * $quantity;

            // Insertar en la tabla compras
            $sql = "INSERT INTO compras (id_usuario, id_producto, cantidad, precio_total) VALUES (:user_id, :product_id, :quantity, :price_total)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price_total', $price_total, PDO::PARAM_STR);
            $stmt->execute();

            // Actualizar cantidad disponible en productos
            $sql_update = "UPDATE productos SET cantidad_disponible = cantidad_disponible - :quantity WHERE id_producto = :product_id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt_update->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt_update->execute();
        }

        // Vaciar el carrito
        unset($_SESSION['cart']);

        // Establecer mensaje de éxito en la sesión
        $_SESSION['success_message'] = "¡Compra realizada con éxito!";
        header("Location: carrito.php"); // Redirigir para mostrar el mensaje
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener el mensaje de éxito y luego borrarlo
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Dulcería "Sugar Kei"</title>
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

    <!-- Mensaje de éxito flotante -->
    <?php if ($success_message): ?>
    <div class="success-message" id="success-message"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <section id="welcome-section">
        <div class="titulo">
        <h2>Carrito de Compras</h2>
        </div>
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-container">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $product_id => $product):
                            $subtotal = $product['price'] * $product['quantity'];
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <button type="submit" name="remove" class="remove-button">Quitar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3 class="total-amount">Total a Pagar: $<?php echo number_format($total, 2); ?></h3>
                <div class="cart-actions">
                    <a href="index.php" class="continue-shopping-button">Seguir Comprando</a>
                    <form method="POST" action="">
                        <button type="submit" name="checkout" class="checkout-button">Pagar</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p class="centro">Tu carrito está vacío.</p>
        <?php endif; ?>
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
            var successMessage = document.getElementById('success-message');
            successMessage.style.display = 'block'; // Mostrar el mensaje

            setTimeout(function() {
                successMessage.style.display = 'none'; // Ocultar el mensaje después de 3 segundos
            }, 3000);
        }, 1000); // Mostrar después de 1 segundo
    </script>
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
