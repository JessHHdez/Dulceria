<?php
session_start();
include_once 'CConexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    try {
        $conn = CConexion::conexionBD();

        if ($conn) {
            $sql = "SELECT * FROM usuario WHERE usuario = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['contrasena'])) {
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['es_admin'] = $user['es_admin'];
                $_SESSION['user_id'] = $user['id_usuario']; // Asegúrate de que este campo coincida con la columna de tu base de datos

                header("Location: index.php");
                exit();
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        } else {
            echo "No se pudo establecer conexión con la base de datos.";
        }
    } catch(PDOException $e) {
        echo "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Dulcería "Sugar Kei"</title>
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
            <h2>Iniciar Sesión</h2>
            <form action="iniciar_sesion.php" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</body>
</html>
