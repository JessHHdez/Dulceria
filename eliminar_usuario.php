<?php
session_start();
include 'CConexion.php'; // Incluye tu archivo de conexión a la base de datos

// Verifica si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['user_id']) || !$_SESSION['es_admin']) {
    header("Location: iniciar_sesion.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $id_usuario = $_POST['id_usuario'];

    $conn = CConexion::conexionBD();
    $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}
?>
