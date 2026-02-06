<?php
session_start();
include_once 'CConexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanear los datos del formulario
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contrasena = filter_var($_POST['contrasena'], FILTER_SANITIZE_STRING);
    $confirm_contrasena = filter_var($_POST['confirm-contrasena'], FILTER_SANITIZE_STRING);

    // Verificar que las contraseñas coincidan
    if ($contrasena !== $confirm_contrasena) {
        die("Las contraseñas no coinciden.");
    }

    // Hashear la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        // Establecer la conexión a la base de datos
        $conn = CConexion::conexionBD();

        // Preparar la consulta de inserción
        $sql = "INSERT INTO usuario (usuario, correo, contrasena) VALUES (:usuario, :correo, :contrasena)";
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $hashed_password);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el ID del usuario recién registrado
        $user_id = $conn->lastInsertId('usuario_id_usuario_seq');

        // Establecer el ID del usuario en la sesión
        $_SESSION['user_id'] = $user_id;

        // Redirigir al usuario a la página del carrito
        header("Location: carrito.php");
        exit();

    } catch(PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>
