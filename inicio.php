<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    echo "Bienvenido, $usuario!";
    echo "<br><a href='cerrar_sesion.php'>Cerrar Sesión</a>";
} else {
    echo "Debe iniciar sesión.";
    echo "<br><a href='login.html'>Iniciar Sesión</a>";
}
?>
