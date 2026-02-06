<?php
// Incluir el archivo de conexión a la base de datos
include_once 'CConexion.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirm_contrasena = $_POST['confirm-contrasena'];

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirm_contrasena) {
        echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    } else {
        // Establecer la conexión a la base de datos
        $conn = CConexion::conexionBD();

        // Hashear la contraseña antes de guardarla en la base de datos
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            // Preparar la consulta SQL para insertar un nuevo usuario
            $sql = "INSERT INTO usuario (usuario, correo, contrasena) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario, $correo, $hashed_password]);

            echo "Registro exitoso. ¡Bienvenido!";
            // Redirigir a otra página después del registro
            header("Location: iniciar_sesion.php");
            exit();
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Dulcería "Sugar Kei"</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="home-title-container">
            <div class="corner-gif top-left"></div>
            <h1>Dulcería "Sugar Kei"</h1>
            <div class="corner-gif top-right"></div>
        </div>
    </header>

    <div class="container">
        <div class="auth-form">
            <h2>Registro</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="usuario" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="correo" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="contrasena" required>

                <label for="confirm-password">Confirmar Contraseña:</label>
                <input type="password" id="confirm-password" name="confirm-contrasena" required>

                <button type="submit">Registrarse</button>
            </form>
            <p>¿Ya tienes una cuenta? <a href="iniciar_sesion.php">Inicia sesión aquí</a></p>
        </div>
    </div>

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
