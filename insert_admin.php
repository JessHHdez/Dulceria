<?php
include 'CConexion.php'; // Incluye tu archivo de conexión a la base de datos

// Datos del administrador
$usuario = 'admin';
$correo = 'admin@gmail.com';
$contrasena = 'admin'; // Cambia esta contraseña a la que desees
$es_admin = true;

// Encriptar la contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

$conn = CConexion::conexionBD();
$query = "INSERT INTO usuario (usuario, correo, contrasena, es_admin) VALUES (:usuario, :correo, :contrasena, :es_admin)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':contrasena', $contrasena_hash);
$stmt->bindParam(':es_admin', $es_admin, PDO::PARAM_BOOL);
$stmt->execute();

echo "Administrador insertado con éxito.";
?>
