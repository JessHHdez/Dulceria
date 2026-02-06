<?php
session_start();
include 'CConexion.php'; // Incluye tu archivo de conexión a la base de datos

// Verifica si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['user_id']) || !$_SESSION['es_admin']) {
    header("Location: iniciar_sesion.php");
    exit;
}

// Procesar la acción de agregar productos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $precio_unidad = $_POST['precio_unidad'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_folder = 'images/' . $imagen;

    move_uploaded_file($imagen_temp, $imagen_folder);

    $conn = CConexion::conexionBD();
    $sql = "INSERT INTO productos (nombre, precio_unidad, cantidad_disponible, descripcion, categoria, imagen) VALUES (:nombre, :precio_unidad, :cantidad_disponible, :descripcion, :categoria, :imagen)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio_unidad', $precio_unidad);
    $stmt->bindParam(':cantidad_disponible', $cantidad_disponible);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':imagen', $imagen);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}

// Procesar la acción de editar productos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $product_id = $_POST['product_id'];
    $nombre = $_POST['nombre'];
    $precio_unidad = $_POST['precio_unidad'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_folder = 'images/' . $imagen;

    if (!empty($imagen)) {
        move_uploaded_file($imagen_temp, $imagen_folder);
        $sql = "UPDATE productos SET nombre = :nombre, precio_unidad = :precio_unidad, cantidad_disponible = :cantidad_disponible, descripcion = :descripcion, categoria = :categoria, imagen = :imagen WHERE id_producto = :product_id";
    } else {
        $sql = "UPDATE productos SET nombre = :nombre, precio_unidad = :precio_unidad, cantidad_disponible = :cantidad_disponible, descripcion = :descripcion, categoria = :categoria WHERE id_producto = :product_id";
    }

    $conn = CConexion::conexionBD();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio_unidad', $precio_unidad);
    $stmt->bindParam(':cantidad_disponible', $cantidad_disponible);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':categoria', $categoria);
    if (!empty($imagen)) {
        $stmt->bindParam(':imagen', $imagen);
    }
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}

// Procesar la acción de eliminar productos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $product_id = $_POST['product_id'];

    $conn = CConexion::conexionBD();
    $sql = "DELETE FROM productos WHERE id_producto = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}

// Obtener la lista de productos
$conn = CConexion::conexionBD();
$sql = "SELECT * FROM productos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener la lista de usuarios
$sql_users = "SELECT * FROM usuario";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->execute();
$usuarios = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Dulcería "Sugar Kei"</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="home-title-container">
            <div class="corner-gif top-left"></div>
            <h1>Administración - Dulcería "Sugar Kei"</h1>
            <div class="corner-gif top-right"></div>
        </div>
    </header>
    <div class="auth-buttons">
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
        <a href="cerrar_sesion.php" class="auth-button">Cerrar sesión</a>
    </div>
    <nav>
        <a href="index.php" id="inicio-link">Inicio</a>
        <a href="carrito.php" id="carrito-link">Carrito</a>
        <a href="informacion.php">Información</a>
        <a href="contacto.php">Contacto</a>
    </nav>
    <section id="admin-section">
        <div class="titulo">
            <h2>Gestión de Productos</h2>
        </div>
        <div class="admin-container">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                      <form method="POST" action="" enctype="multipart/form-data">
                        <td>
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        </td>
                        <td>
                            <input type="text" name="precio_unidad" value="<?php echo number_format($producto['precio_unidad'], 2); ?>">
                        </td>
                        <td>
                            <input type="text" name="cantidad_disponible" value="<?php echo htmlspecialchars($producto['cantidad_disponible']); ?>">
                        </td>
                        <td>
                            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>">
                        </td>
                        <td>
                            <select name="categoria">
                                <option value="caramelos" <?php if($producto['categoria'] == 'caramelos') echo 'selected'; ?>>Caramelos</option>
                                <option value="chocolates" <?php if($producto['categoria'] == 'chocolates') echo 'selected'; ?>>Chocolates</option>
                                <option value="galletas" <?php if($producto['categoria'] == 'galletas') echo 'selected'; ?>>Galletas</option>
                                <option value="confites y gomitas" <?php if($producto['categoria'] == 'confites y gomitas') echo 'selected'; ?>>Confites y Gomitas</option>
                                <option value="turrones y mazapanes" <?php if($producto['categoria'] == 'turrones y mazapanes') echo 'selected'; ?>>Turrones y Mazapanes</option>
                            </select>
                        </td>
                        <td>
                            <input type="file" name="imagen">
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="images/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="width:50px;height:50px;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="hidden" name="product_id" value="<?php echo $producto['id_producto']; ?>">
                            <button type="submit" name="edit" class="edit-button">Editar</button>
                            <button type="submit" name="delete" class="delete-button">Eliminar</button>
                        </td>
                      </form>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <td><input type="text" name="nombre" placeholder="Nuevo producto"></td>
                            <td><input type="text" name="precio_unidad" placeholder="Precio"></td>
                            <td><input type="text" name="cantidad_disponible" placeholder="Cantidad"></td>
                            <td><input type="text" name="descripcion" placeholder="Descripción"></td>
                            <td>
                                <select name="categoria">
                                    <option value="caramelos">Caramelos</option>
                                    <option value="chocolates">Chocolates</option>
                                    <option value="galletas">Galletas</option>
                                    <option value="confites y gomitas">Confites y Gomitas</option>
                                    <option value="turrones y mazapanes">Turrones y Mazapanes</option>
                                </select>
                            </td>
                            <td><input type="file" name="imagen"></td>
                            <td>
                                <button type="submit" name="add" class="add-button">Agregar</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="titulo">
            <h2>Gestión de Usuarios</h2>
        </div>
        <div class="admin-container">
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                        <td>
                            <!-- Añade aquí botones o enlaces para eliminar usuarios si es necesario -->
                            <form method="POST" action="eliminar_usuario.php">
                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                                <button type="submit" name="delete_user" class="delete-button">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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

</html>
